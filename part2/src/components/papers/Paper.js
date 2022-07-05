import React from "react";
import "../MainPages.css";

/**
 * Displays a list of papers 
 * 
 * Displays a list of all the papers. When a paper is
 * clicked, more information is displayed about the papers including the 
 * title, abstract, authors associated with it and DOI.
 *
 * @var this.props.paper.paper_id - used as a paramater 
 * for the author api endpoint
 * @var this.props.paper.title - holds the paper title
 * @var this.props.paper.abstract - holds the paper abstract
 * @var this.props.paper.doi - holds the paper DOI
 * 
 * @var this.state.authors - holds the authors associated with the paper
 * @var this.state.authors - holds the authors associated with the paper
 * @var this.state.results - holds the results
 * @var this.state.display - displays the paper details
 *
 * @author Graham Stoves, w19025672
 */

class Paper extends React.Component {

    constructor(props) {
        super(props)
        this.state = {
            display: false,
            authors: []
        }
        this.handleClick = this.handleClick.bind(this);
    }

    handleClick() {
        // loads the authors that are associated with each paper
        fetch("http://unn-w19025672.newnumyspace.co.uk/kf6012/coursework/part1/api/authors?paperid=" + this.props.paper.paper_id)
            .then((response) => {
                if (response.status === 200) {
                    return response.json()
                } else {
                    throw Error(response.statusText);
                }
            })
            .then((data) => {
                this.setState({
                    authors: data.results
                })
            })
            .catch((err) => {
                console.log("something went wrong ", err);
            });
        this.setState({
            display: !this.state.display
        });
    }

    render() {
        let details = ""
        let noData = ""

        // displays a message if no data is available, else displays the details

        if (this.state.results === null) {
            noData = <p>No data</p>
        }

        if (this.state.display) {
            details =
                <div className="detailsContainer">
                    <p className="detailsHeading">Abstract</p>
                    <p className="details">
                        {this.props.paper.abstract}
                    </p>
                    <p className="detailsHeading">Authors</p>
                    {
                        this.state.authors.map((author) => (
                            <p key={author.author_id}>
                                {author.first_name + " " + author.middle_name + " " + author.last_name}
                            </p>
                        ))
                    }
                    <p className="detailsHeading">DOI</p>
                    <a className="doiLink" target="_blank" href={this.props.paper.doi}>{this.props.paper.doi}</a>
                </div>
        }

        return (
            <div className="topContainer" onClick={this.handleClick}>
                {noData}
                <p>{this.props.paper.title}</p>
                {details}
            </div>
        )

    }
}

export default Paper;