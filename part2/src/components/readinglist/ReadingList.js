import React from "react";
import CheckBox from "../pagecomponents/CheckBox.js";
import Paper from "../papers/Paper.js";
import SelectList from "../pagecomponents/SelectList.js";

/**
 * ReadingList displays papers in users list
 * 
 * This class displays a list of all the papers and allows the user
 * to filter the list to show papers they have added to their reading 
 * list. The user can also add and remove papers from their list.
 *
 * @var this.state.results - holds all of the papers from the database
 * @var this.state.readinglist - holds all the papers in the users reading list
 * @var this.state.selectedReadingList - holds the value of the select list in 
 * SelectList.js
 * 
 * @author Graham Stoves, w19025672
 */

class ReadingList extends React.Component {
    constructor(props) {
        super(props)
        this.state = {
            results: [],
            readingList: [],
            selectedReadingList: ""
        }
        this.handleSelectChange = this.handleSelectChange.bind(this)
    }

    componentDidMount() {
        // loads all the papers
        let papersUrl = "http://unn-w19025672.newnumyspace.co.uk/kf6012/coursework/part1/api/papers"

        fetch(papersUrl)
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
            })

        // loads the users reading list
        let readingListUrl = "http://unn-w19025672.newnumyspace.co.uk/kf6012/coursework/part1/api/readinglist"

        let formData = new FormData();
        formData.append('token', this.props.token)

        fetch(readingListUrl, {
            method: 'POST',
            headers: new Headers(),
            body: formData
        })
            .then((response) => {
                if (response.status === 200) {
                    return response.json()
                } else {
                    throw Error(response.statusText);
                }
            })
            .then((data) => {
                this.setState({
                    readingList: data.results
                })
            })
            .catch((err) => {
                console.log("Something went wrong ", err)
            });
    }

    // when user selects an option in SelectList.js, the value of selectedReadingList is changed
    handleSelectChange = (e) => {
        this.setState({
            selectedReadingList: e.target.value
        })
    }

    // filters the reading list to show the users papers if they select that option in the select list dropdown
    filterReadingList = (s) => {
        switch (this.state.selectedReadingList) {
            case "1":
                let inUserList = null
                this.state.readingList.forEach((item) => {
                    if (item.paper_id === s.paper_id) inUserList = item
                })
                return inUserList
            default:
                return s
        }
    }

    render() {
        let results = this.state.results
        let noData = ""

        if (this.state.results === null) {
            noData = <p>No data</p>
        }

        // filters the results depending on the option the user has selected
        if ((results.length > 0) && (this.state.readingList.length > 0)) {
            results = results.filter(this.filterReadingList)
        }

        return (
            <div>
                {noData}
                <SelectList
                    selectedReadingList={this.state.selectedReadingList}
                    handleReadingList={this.handleSelectChange}
                />
                {results.map((paper) => (
                    <div key={paper.paper_id}>
                        <Paper paper={paper} />
                        <div className="readingList">
                            <CheckBox
                                readingList={this.state.readingList}
                                paper_id={paper.paper_id}
                            />
                        </div>
                    </div>
                ))}
            </div>
        )
    }
}
export default ReadingList;