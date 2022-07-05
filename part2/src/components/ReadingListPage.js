import React from "react";
import Login from "./pagesections/Login.js";
import Logout from "./pagesections/Logout.js";
import ReadingList from "./readinglist/ReadingList.js";

/**
 * Displays the reading list page
 * 
 * This page displays a login form. Once the user logs in they will be able to 
 * view all the papers, as well as a select box which allows the
 * user to filter the results based on whether a paper is in their list. Also 
 * includes a checkbox next to each paper that the user can check or uncheck to 
 * save or remove a paper from their list. Once logged in, the page will also 
 * display a logout button.
 *
 * @var this.state.email - holds the email the user types in
 * @var this.state.password - holds the password the user types in
 *
 * @author Graham Stoves, w19025672
 */

class ReadingListPage extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            authenticated: false,
            email: "",
            password: "",
            token: null
        }
        this.handleEmail = this.handleEmail.bind(this)
        this.handlePassword = this.handlePassword.bind(this)
        this.handleLoginClick = this.handleLoginClick.bind(this)
        this.handleLogoutClick = this.handleLogoutClick.bind(this)
    }

    // if the user has a vaild token, authenticated is set to true
    componentDidMount() {
        if (localStorage.getItem('myReadingListToken')) {
            this.setState({
                authenticated: true,
                token: localStorage.getItem('myReadingListToken')
            })
        }
    }

    // this sets the password to what the user inputted
    handlePassword = (e) => {
        this.setState({
            password: e.target.value
        })
    }

    // this sets the email to what the user inputted
    handleEmail = (e) => {
        this.setState({
            email: e.target.value
        })
    }

    handleLoginClick = () => {
        // handles the authentication of the user
        let url = "http://unn-w19025672.newnumyspace.co.uk/kf6012/coursework/part1/api/authenticate"

        let formData = new FormData()
        formData.append('email', this.state.email)
        formData.append('password', this.state.password)

        fetch(url, {
            method: 'POST',
            headers: new Headers(),
            body: formData
        })
            .then((response) => {
                if (response.status === 200) {
                    return response.json()
                } else {
                    throw Error(response.statusText)
                }
            })
            .then((data) => {
                // if they have a token, set authenticate to true
                if ("token" in data.results) {
                    localStorage.setItem('myReadingListToken', data.results.token)
                    this.setState({
                        authenticated: true,
                        token: data.results.token
                    })
                }
            })
            .catch((err) => {
                console.log("Something went wrong", err)
            })
    }

    // if they click the logout button, set authenticated to false
    handleLogoutClick = () => {
        this.setState({
            authenticated: false,
            token: null
        })
        localStorage.removeItem('myReadingListToken')
    }

    render() {
        let page = (
            <Login
                handleEmail={this.handleEmail}
                handlePassword={this.handlePassword}
                handleLoginClick={this.handleLoginClick}
            />
        )
        if (this.state.authenticated) {
            page = (
                <div>
                    <Logout handleLogoutClick={this.handleLogoutClick}
                    />
                    <ReadingList token={this.state.token} />
                    <Logout handleLogoutClick={this.handleLogoutClick}
                    />
                </div>
            )
        }
        return (
            <div>{page}</div>
        )
    }
}

export default ReadingListPage;