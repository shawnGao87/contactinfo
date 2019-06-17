<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Validation\Rule;
use GuzzleHttp\Client;

class ContactsController extends Controller
{

    /**
     * # Display a listing of the Contacts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = $this->all_contacts();
        return response($contacts);
    }

    /**
     * # Show the form for creating a new Contact.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /**
         * ## instantiate a new Contact object and pass to the view
         * ## the empty properties of Contact will be used as values of inputs
         * ## purpose is that Edit and Create can use the same form
         * ## without an empty Contact, it'd throw errors
         */
        $contact = new Contact();
        $states = $this->state_arr();
        return view('create_form', compact('contact', 'states'));
    }

    /**
     * Store a newly created Contact in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $validated_request = $this->validate_post();
        Contact::create($validated_request);
        return redirect('/')->with('success', 'Contact created successfully');
    }


    /**
     * Show the form for editing the specified Contact.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        /**
         * !! Getting Geocode from Google Map API
         */
        $address = $contact->street_name . ', ' . $contact->city . ', ' . $contact->state . ' ' . $contact->zip;
        $client = new Client(['verify' => false]);
        $api_key = env('GOOGLE_MAPS_API_KEY');
        $result = $client->post('https://maps.googleapis.com/maps/api/geocode/json?address=' . $address . '&key=' . $api_key)->getBody();
        $json = json_decode($result);
        $states = $this->state_arr();

        /**
         * !! In case bad addresses and unable to retrieve geocode
         */
        if ($json->results) {
            $contact->lat = $json->results[0]->geometry->location->lat;
            $contact->lng = $json->results[0]->geometry->location->lng;
            return view('edit_form', compact('contact', 'states'));
        } else {
            $map_error = 'Unable to retrieve the address location';
            return view('edit_form', compact('contact', 'states', 'map_error'));
        }
    }

    /**
     * Update the specified Contact in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Contact $contact)
    {
        $validated_request = $this->validate_post($contact->id);
        $contact->update($validated_request);

        return redirect('/')->with('success', 'Updated Contact Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        /**
         * !! delete is done via Axios
         * !! return all contacts as response for the callback
         * !! so the UI can refresh
         */
        $contacts = $this->all_contacts();
        return response($contacts);
    }


    /**
     * !! $contact_id is for validating unique email when updating contacts
     * !! default to empty string for creating contacts
     */
    protected function validate_post($contact_id = '')
    {

        return request()->validate([
            'first_name' => [
                'required',
                'regex:/[a-zA-Z\s\',\.-]+$/'
            ],
            'last_name' => [
                'required',
                'regex:/[a-zA-Z\s\',\.-]+$/'
            ],
            'email' => 'required|email|unique:contacts,email,' . $contact_id,
            'phone' => [
                'nullable',
                'string',
                'regex:/^(\+*\d{1,4}[\s-]*)*\(*\d{3}\)*[\s.-]*\d{3}[\s.-]*\d{4}$/'
            ],
            'birthday' => 'date|nullable|before:tomorrow|after:1000-01-01',
            'street_address' => [
                'nullable',
                'string',
                'regex:/^\d+\s+([a-zA-Z\s\.0-9])+$/'
            ],
            'city' => [
                'nullable',
                'string',
                'regex:/^[a-zA-Z]+/'
            ],
            'state' => [
                'nullable',
                // state is dropdown, but in case user changes the option in browser
                Rule::in(array_values($this->state_arr()))
            ],
            'zip' => [
                'nullable',
                'regex:/\d{5}([\s-]+\d{4})*$/'
            ],
        ]);
    }

    protected function state_arr()
    {
        return [
            "AK" => "Alaska",
            "AL" => "Alabama",
            "AR" => "Arkansas",
            "AS" => "American Samoa",
            "AZ" => "Arizona",
            "CA" => "California",
            "CO" => "Colorado",
            "CT" => "Connecticut",
            "DC" => "District of Columbia",
            "DE" => "Delaware",
            "FL" => "Florida",
            "GA" => "Georgia",
            "GU" => "Guam",
            "HI" => "Hawaii",
            "IA" => "Iowa",
            "ID" => "Idaho",
            "IL" => "Illinois",
            "IN" => "Indiana",
            "KS" => "Kansas",
            "KY" => "Kentucky",
            "LA" => "Louisiana",
            "MA" => "Massachusetts",
            "MD" => "Maryland",
            "ME" => "Maine",
            "MI" => "Michigan",
            "MN" => "Minnesota",
            "MO" => "Missouri",
            "MS" => "Mississippi",
            "MT" => "Montana",
            "NC" => "North Carolina",
            "ND" => "North Dakota",
            "NE" => "Nebraska",
            "NH" => "New Hampshire",
            "NJ" => "New Jersey",
            "NM" => "New Mexico",
            "NV" => "Nevada",
            "NY" => "New York",
            "OH" => "Ohio",
            "OK" => "Oklahoma",
            "OR" => "Oregon",
            "PA" => "Pennsylvania",
            "PR" => "Puerto Rico",
            "RI" => "Rhode Island",
            "SC" => "South Carolina",
            "SD" => "South Dakota",
            "TN" => "Tennessee",
            "TX" => "Texas",
            "UT" => "Utah",
            "VA" => "Virginia",
            "VI" => "Virgin Islands",
            "VT" => "Vermont",
            "WA" => "Washington",
            "WI" => "Wisconsin",
            "WV" => "West Virginia",
            "WY" => "Wyoming"
        ];
    }
    /**
     * # Get all contacts except for the columns of created_at, updated_at
     */
    protected function all_contacts()
    {
        $contacts = Contact::all(['id', 'first_name', 'last_name', 'email', 'phone', 'birthday', 'street_address', 'city', 'state', 'zip']);
        return $contacts;
    }
}
