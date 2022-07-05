import React from "react";
import Paper from "./Paper.js";
import "../MainPages.css";

/**
 * Filters paper data
 * 
 * Receives all the papers from the PapersPage object and filters
 * through the results, maps them and passes the data to each individual paper 
 * object, allowing the user to search for a paper and navigate each page
 *
 * @var this.state.results - holds all of the papers from the database
 * @var this.props.search - used to filter the paper based
 * on the title and abstract
 * @var this.props.page - holds the current page number
 * @var this.props.randomPaper - holds a random paper
 * @var this.props.authorid - holds the authors id
 * @var this.props.award_type_id) - holds the award id
 *
 * @method this.props.handlePreviousClick - displays the papers on previous 
 * page
 * @method this.props.handleNextClick - displays the papers on next page
 *
 * @author Graham Stoves, w19025672
 */

class Papers extends React.Component {

    constructor(props) {
        super(props)
        this.state = {
            results: []
        }
    }

    componentDidMount() {
        // loads all the papers
        let url = "http://unn-w19025672.newnumyspace.co.uk/kf6012/coursework/part1/api/papers"

        // finds papers based on the author id or finds a random paper to display on homepage
        if (this.props.authorid !== undefined) {
            url += "?authorid=" + this.props.authorid
        } else if (this.props.randomPaper) {
            url += "?random=true"
        }

        fetch(url)
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
                console.log("Something went wrong ", err)
            });
    }

    // retunrs the papers based on what award they have won
    filterByAward = (award_type) => {
        return ((award_type.award_type_id === this.props.award_type_id) || (this.props.award_type_id === ""))
    }

    // filters the results based on the papers title and abstract
    filterSearch = (s) => {
        return (
            s.title.toLowerCase().includes(this.props.search.toLowerCase())
            || s.abstract.toLowerCase().includes(this.props.search.toLowerCase())
        )
    }

    render() {
        let noData = ""
        let buttons = ""
        let filteredResults = this.state.results

        if (this.state.results === null) {
            noData = <p>No data</p>
        }

        // if user starts typing, filter through search results
        if ((filteredResults.length > 0) && (this.props.search !== undefined)) {
            filteredResults = filteredResults.filter(this.filterSearch)
        }

        // if user uses the dropdown, the papers are filtered based on award won
        if (this.props.award_type_id !== undefined) {
            filteredResults = filteredResults.filter(this.filterByAward)
        }

        // only displays 25 papers per page
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
            <div>
                {noData}
                {filteredResults.map((paper) => (<Paper key={paper.title} paper={paper} />))}
                {buttons}
            </div>
        )
    }
}

export default Papers;