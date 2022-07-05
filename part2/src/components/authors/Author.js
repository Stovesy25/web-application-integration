import React from "react";
import "../MainPages.css";

/**
 * Displays a list of authors 
 * 
 * Displays a list of all the authors. When an author is
 * clicked, information is displayed about the papers 
 * associated with that author.
 *
 * @var this.props.result.author_id - used as a paramater 
 * for the paper api endpoint
 * @var paper.paper_id - used as a paramater for the paper api endpoint
 * @var this.props.result.first_name - holds authors first name
 * @var this.props.result.middle_name - holds authors middle name
 * @var this.props.result.last_name - holds authors last name
 *
 * @var paperDetails - holds the papers associated with the author
 * 
 * @var this.state.papers - holds details of the papers
 * @var this.state.authors - holds details of the authors of the paperDetails
 * @var this.state.display - displays the paper details
 *
 * @author Graham Stoves, w19025672
 */

class Author extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            display: false,
            papers: [],
            authors: []
        }
        this.handleClick = this.handleClick.bind(this);
    }

    componentDidMount() {
        // loads the papers associated with the author that has been clicked
        fetch("http://unn-w19025672.newnumyspace.co.uk/kf6012/coursework/part1/api/papers?authorid=" + this.props.result.author_id)
            .then((response) => {
                if (response.status === 200) {
                    return response.json()
                } else {
                    throw Error(response.statusText);
                }
            })
            .then((data) => {
                this.setState({
                    papers: data.results
                })
            })
            .then(() => {
                this.state.papers.forEach((paper) => {
                    // loads the authors where the paper is associated with the clicked author
                    fetch("http://unn-w19025672.newnumyspace.co.uk/kf6012/coursework/part1/api/authors?paperid=" + paper.paper_id)
                        .then((response) => {
                            if (response.status === 200) {
                                return response.json()
                            } else {
                                throw Error(response.statusText);
                            }
                        })
                        .then((data) => {
                            this.state.authors.push(data.results);
                        })
                        .catch((err) => {
                            console.log("something went wrong ", err);
                        })
                })
            })
            .catch((err) => {
                console.log("something went wrong ", err);
            });
    }

    // loads the paper details when clicked and hides them when clicked again
    handleClick() {
        this.setState({
            display: !this.state.display
        });
    }

    render() {
        let paperDetails = "";
        let noData = ""

        if (this.state.results === null) {
            noData = <p>No data</p>
        }

        // if the display is true and there are papers and authors there, display the details, else just show the authors name
        if (this.state.display && this.state.papers.length !== 0 && this.state.authors.length !== 0) {
            paperDetails =
                <div className="detailsContainer">
                    {
                        this.state.papers.map((paper, i) => (
                            <div key={i}>
                                <p className="detailsHeading">Title</p>
                                <p>{paper.title}</p>
                                <p className="detailsHeading">Abstract</p>
                                <p className="details">{paper.abstract}</p>
                                <p className="detailsHeading">Authors</p>
                                {
                                    this.state.authors[i].map((author) => (
                                        <div key={author.author_id}>
                                            <p>{author.first_name} {author.middle_name} {author.last_name}</p>
                                        </div>
                                    ))
                                }
                                <p className="detailsHeading">DOI</p>
                                <a className="doiLink" target="_blank" href={paper.doi}>{paper.doi}</a>
                            </div>
                        ))
                    }
                </div>
        }

        return (
            <div className="topContainer" onClick={this.handleClick}>
                {noData}
                <p>{this.props.result.first_name} {this.props.result.middle_name} {this.props.result.last_name}</p>
                {paperDetails}
            </div>
        )
    }
}

export default Author;