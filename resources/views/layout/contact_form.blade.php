{{-- 
    
    ## When form is used by Edit, $contact will be the contact being edited
    ## When form is used by Create, $contact will be an empty Contact object just so the form doesn't throw errors
    ## old() captures the value being submitted and return that value in case there was any error from validation.    
    
--}}

    @csrf
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input name="first_name" type="input" class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="" value="{{ old('first_name') ?? $contact->first_name}}" id="first_name"  >
        @if ($errors->has('first_name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('first_name') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input name="last_name" type="input" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" value="{{ old('last_name') ?? $contact->last_name}}" id="last_name"  >
        @if ($errors->has('last_name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('last_name') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input name="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') ?? $contact->email}}" id="email" >
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input name="phone" type="input" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') ?? $contact->phone}}" id="phone" >
        @if ($errors->has('phone'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="birthday">Birthday</label>
        <input name="birthday" type="date" class="form-control {{ $errors->has('birthday') ? ' is-invalid' : '' }}" value="{{ old('birthday') ?? $contact->birthday}}" id="birthday" >
        @if ($errors->has('birthday'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('birthday') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="street_address">Street Address</label>
        <input name="street_address" type="input" class="form-control {{ $errors->has('street_address') ? ' is-invalid' : '' }}" value="{{ old('street_address') ?? $contact->street_address}}" id="street_address" >
        @if ($errors->has('street_address'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('street_address') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="city">City</label>
        <input name="city" type="input" class="form-control {{ $errors->has('city') ? ' is-invalid' : '' }}" value="{{ old('city') ?? $contact->city}}" id="city" >
        @if ($errors->has('city'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('city') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="state">State</label>
        <select class="form-control {{ $errors->has('state') ? ' is-invalid' : '' }}"  id="state" >
            <option value="select state" disabled>Select Sate</option>
            @foreach ($states as $state_abrv => $state_name)
                <option value="{{$state_name}}" {{$contact->state == $state_name ? 'selected': ''}}>{{$state_name}} </option>
            @endforeach
        </select>
        @if ($errors->has('state'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('state') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="zip">Zip</label>
        <input name="zip" type="input" class="form-control {{ $errors->has('zip') ? ' is-invalid' : '' }}" value="{{ old('zip') ?? $contact->zip}}" id="zip" >
        @if ($errors->has('zip'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('zip') }}</strong>
            </span>
        @endif
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href='/' class="btn btn-danger">Cancel</a>
