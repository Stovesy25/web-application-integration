import React from "react";
import Papers from "./papers/Papers.js";
import SelectAward from "./pagecomponents/SelectAward.js";
import SearchBox from "./pagecomponents/SearchBox.js";

/**
 * Displays the papers
 * 
 * This page displays all the papers, as well as a search bar at the type 
 * and buttons at the bottom to allow the user to navigate to the previous 
 * and next page. If the user clicks on a paper, more details will be 
 * displayed.
 *
 * @var this.state.results - holds all of the authors from the database
 * @var this.state.search - used to filter the author based
 * on their first and last name
 * @var this.state.page - holds the current page number
 * @var this.state.award_type_id - holds the award type id
 *
 * @method this.props.handlePreviousClick - displays the authors on previous 
 * page
 * @method this.props.handleNextClick - displays the authors on next page
 *
 * @author Graham Stoves, w19025672
 */

class PapersPage extends React.Component {

    constructor(props) {
        super(props)
        this.state = {
            award_type_id: "",
            search: "",
            page: 1
        }
        this.handleAwardSelect = this.handleAwardSelect.bind(this);
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

    // allows user to select paper based on award, resets page to 1
    handleAwardSelect = (e) => {
        this.setState({
            award_type_id: e.target.value, page: 1
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
                    placeholder='Search papers...'
                    search={this.state.search}
                    handleSearch={this.handleSearch} />
                <SelectAward
                    award_type_id={this.state.award_type_id}
                    handleAwardSelect={this.handleAwardSelect} />
                <Papers
                    award_type_id={this.state.award_type_id}
                    search={this.state.search}
                    page={this.state.page}
                    handleNextClick={this.handleNextClick}
                    handlePreviousClick={this.handlePreviousClick}
                />
            </div>
        )
    }
}

export default PapersPage;