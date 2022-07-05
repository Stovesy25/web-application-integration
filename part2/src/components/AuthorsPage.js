import React from "react";
import Authors from "./authors/Authors.js";
import SearchBox from "./pagecomponents/SearchBox.js";

/**
 * Displays the authors
 * 
 * This page displays all the authors, as well as a search bar at the type 
 * and buttons at the bottom to allow the user to navigate to the previous 
 * and next page. If the user clicks on an author, more details will be 
 * displayed.
 *
 * @var this.state.results - holds all of the authors from the database
 * @var this.state.search - used to filter the author based
 * on their first and last name
 * @var this.state.page - holds the current page number
 *
 * @method this.props.handlePreviousClick - displays the authors on previous 
 * page
 * @method this.props.handleNextClick - displays the authors on next page
 *
 * @author Graham Stoves, w19025672
 */

class AuthorsPage extends React.Component {
    constructor(props) {
        super(props)
        this.state = {
            search: "",
            page: 1
        }
        this.handleSearch = this.handleSearch.bind(this);
        this.handleNextClick = this.handleNextClick.bind(this);
        this.handlePreviousClick = this.handlePreviousClick.bind(this);
    }

    // allows user to search in bar, resets the page to 1
    handleSearch = (e) => {
        this.setState({
            search: e.target.value, page: 1
        })
    }

    // goes to next page by adding one to the page state
    handleNextClick = () => {
        this.setState({
            page: this.state.page + 1
        })
    }

    // goes to previous page by taking away one to the page state
    handlePreviousClick = () => {
        this.setState({
            page: this.state.page - 1
        })
    }

    render() {
        return (
            <div>
                <SearchBox
                    placeholder='Search authors...'
                    search={this.state.search}
                    handleSearch={this.handleSearch}
                />
                <Authors
                    search={this.state.search}
                    page={this.state.page}
                    handleNextClick={this.handleNextClick}
                    handlePreviousClick={this.handlePreviousClick}
                />
            </div>
        )
    }
}

export default AuthorsPage;