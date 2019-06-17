import React, { Component } from "react";
import ReactDOM from "react-dom";
import Axios from "axios";
import MUIDataTable from "mui-datatables";
export default class ContactList extends Component {
    constructor() {
        super();
        this.state = {
            tableOptions: {
                selectableRows: "none",
                print: false,
                download: false,
                rowsPerPageOptions: [10, 25, 50, 100]
            },
            columns: [
                {
                    name: "id",
                    label: "ID",
                    options: {
                        display: "excluded",
                        filter: false
                    }
                },
                {
                    name: "first_name",
                    label: "First Name",
                    options: {
                        sortDirection: "asc"
                    }
                },
                {
                    name: "last_name",
                    label: "Last Name"
                },
                {
                    name: "email",
                    label: "Email"
                },
                {
                    name: "phone",
                    label: "Phone"
                },
                {
                    name: "birthday",
                    label: "Birthday"
                },
                {
                    name: "street_address",
                    label: "Street Address"
                },
                {
                    name: "city",
                    label: "City"
                },
                {
                    name: "state",
                    label: "State"
                },
                {
                    name: "zip",
                    label: "Zip"
                },
                {
                    label: "Edit",
                    name: "",
                    options: {
                        searchable: false,
                        sort: false,
                        filter: false,
                        customBodyRender: (value, tableMeta, updateValue) => {
                            const contact_id = tableMeta.rowData
                                ? tableMeta.rowData[0]
                                : "";
                            return (
                                <a
                                    href={`/contact/${contact_id}/edit/`}
                                    className="btn btn-primary"
                                >
                                    Edit
                                </a>
                            );
                        }
                    }
                },

                {
                    label: "Delete",
                    name: "",
                    options: {
                        searchable: false,
                        sort: false,
                        filter: false,
                        customBodyRender: (value, tableMeta, updateValue) => {
                            const contact_id = tableMeta.rowData
                                ? tableMeta.rowData[0]
                                : "";
                            return (
                                <button
                                    name={contact_id}
                                    onClick={this.handleDelete}
                                    className="btn btn-danger"
                                >
                                    Delete
                                </button>
                            );
                        }
                    }
                }
            ],
            rows: [
                {
                    id: "",
                    first_name: "",
                    last_name: "",
                    email: "",
                    phone: "",
                    birthday: "",
                    stree_address: "",
                    city: "",
                    state: "",
                    zip: ""
                }
            ]
        };
    }

    /**
     * !! Handle Delete Request
     */

    handleDelete = e => {
        const contactId = e.target.name;
        Axios.delete(`/contact/${contactId}`).then(res =>
            this.setState({ rows: res.data }, this.afterDelete)
        );
    };

    afterDelete = () => {
        const message_ele = document.getElementById("success_message");
        if (message_ele) {
            message_ele.innerHTML = "Contact Deleted Successfully!";
        } else {
            const ele = React.createElement(
                "div",
                { className: "alert alert-success" },
                "Contact Deleted Successfully!"
            );
            ReactDOM.render(ele, document.getElementById("delete_message"));
        }
    };

    componentWillMount() {
        Axios.get("/contact").then(res => {
            this.setState({ rows: res.data });
        });
    }

    render() {
        const { rows, columns, tableOptions } = this.state;
        return (
            <MUIDataTable
                data={rows}
                columns={columns}
                options={tableOptions}
            />
        );
    }
}

if (document.getElementById("allContacts")) {
    ReactDOM.render(<ContactList />, document.getElementById("allContacts"));
}
