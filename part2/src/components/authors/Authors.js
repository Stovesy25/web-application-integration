import React from "react";
import Author from "./Author.js";
import "../MainPages.css";

/**
 * Filters author data
 * 
 * Receives all the authors from the AuthorsPage object and filters
 * through the results, maps them and passes the data to each individual author 
 * object, allowing the user to search for an author and navigate each page
 *
 * @var this.state.results - holds all of the authors from the database
 * @var this.props.search - used to filter the author based
 * on their first and last name
 * @var this.props.page - holds the current page number
 * @const author_name - holds authors first and last name
 *
 * @method this.props.handlePreviousClick - displays the authors on previous 
 * page
 * @method this.props.handleNextClick - displays the authors on next page
 *
 * @author Graham Stoves, w19025672
 */

class Authors extends React.Component {
    constructor(props) {
        super(props)
        this.state = {
            results: []
        }
    }

    // filters the results based on the authors first and last name
    filterSearch = (s) => {
        const author_name = s.first_name + " " + s.last_name
        return author_name.toLowerCase().includes(this.props.search.toLowerCase())
    }

    componentDidMount() {
        // loads all the authors
        fetch("http://unn-w19025672.newnumyspace.co.uk/kf6012/coursework/part1/api/authors")
            .then((response) => {
                if (response.status === 200) {
                    return response.json()
                } else {
                    throw Error(response.statusText);
                }
            })
            .then((data) => {
                this.setState({
                    results: data.results
                })
            })
            .catch((err) => {
                console.log("something went wrong ", err);
            });
    }

    render() {
        let noData = ""
        let buttons = ""
        let filteredResults = this.state.results

        if (this.state.results === null) {
            noData = <p>No data</p>
        }

        //if user starts typing, filter through search results
        if ((filteredResults.length > 0) && (this.props.search !== undefined)) {
            filteredResults = filteredResults.filter(this.filterSearch)
        }

        // only displays 25 authors per page
        if (this.props.page !== undefined) {
            const pageSize = 25
            let pageMax = this.props.page * pageSize
            let pageMin = pageMax - pageSize

            // displays what the current page is and disables previous button if page is = 1 and next button if user is on the last page
            buttons = (
                <div className="pageNumContainer">
                    <p>Page {this.props.page} of {Math.ceil(filteredResults.length / pageSize)}</p>
                    <button onClick={this.props.handlePreviousClick} disabled={this.props.page <= 1}>Previous</button>
                    <button onClick={this.props.handleNextClick} disabled={this.props.page >= Math.ceil(filteredResults.length / pageSize)}>Next</button>
                </div>
            )
            filteredResults = filteredResults.slice(pageMin, pageMax)
        }

        return (
            <div onClick={this.handleClick}>
                {noData}
                {
                    filteredResults.map((result) => (
                        <Author key={result.author_id} result={result} />
                    ))
                }
                {buttons}
            </div>
        )
    }
}

export default Authors;