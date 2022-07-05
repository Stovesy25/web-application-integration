import React from "react";

/**
 * Displays a checkbox on the reading list page
 *
 * @var this.props.readingList - holds the papers from the paper table
 * @var this.props.paper_id - holds the paper_id to be able to add and remove
 * papers from the reading list
 *
 * @var this.state.checked - tracks the state of the checkbox, whether ticked 
 * or not
 * 
 * @method this.addToReadingList - adds the paper to the reading list
 * @method this.removeFromReadingList - removes the paper from the reading list
 *
 * @author Graham Stoves, w19025672
 */

class CheckBox extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            checked: false
        }
    }

    componentDidMount() {
        // checks if there are any papers on users reading list, if there is, put a tick in the checkbox
        let filteredReadingList = this.props.readingList.filter(
            (item) => (this.isOnList(item))
        )
        if (filteredReadingList.length > 0) {
            this.setState({
                checked: true
            })
        }
    }

    // cheks to see if the paper is in the users list
    isOnList = (item) => {
        return (item.paper_id === this.props.paper_id)
    }

    // if the checkbox is checked, the addToReadingList method is called, if it is unchecked, the removeFromReadingList method is called
    handleOnChange = () => {
        if (this.state.checked) {
            this.removeFromReadingList()
        } else {
            this.addToReadingList()
        }
    }

    // adds paper to the reading list
    addToReadingList = () => {
        let url = "http://unn-w19025672.newnumyspace.co.uk/kf6012/coursework/part1/api/readinglist?"

        let formData = new FormData();
        formData.append('token', localStorage.getItem('myReadingListToken'))
        formData.append('add', this.props.paper_id)

        fetch(url, {
            method: 'POST',
            headers: new Headers(),
            body: formData
        })
            .then((response) => {
                if ((response.status === 200) || (response.status === 204)) {
                    this.setState({
                        checked: !this.state.checked
                    })
                } else {
                    throw Error(response.statusText);
                }
            })
            .catch((err) => {
                console.log("something went wrong ", err)
            });
    }

    // removes paper from the reading list
    removeFromReadingList = () => {
        let url = "http://unn-w19025672.newnumyspace.co.uk/kf6012/coursework/part1/api/readinglist?"

        let formData = new FormData()
        formData.append('token', localStorage.getItem('myReadingListToken'))
        formData.append('remove', this.props.paper_id)

        fetch(url, {
            method: 'POST',
            headers: new Headers(),
            body: formData
        })
            .then((response) => {
                if ((response.status === 200) || (response.status === 204)) {
                    this.setState({
                        checked: !this.state.checked
                    })
                } else {
                    throw Error(response.statusText);
                }
            })
            .catch((err) => {
                console.log("something went wrong ", err)
            });
    }

    render() {
        // if checkbox is checked, display paper saved, else display save paper
        let saved = ""
        if (this.state.checked) {
            saved = "Paper saved"
        } else {
            saved = "Save paper:"
        }

        return (
            <div>
                <label>{saved}</label>
                <input
                    className="checkBox"
                    type="checkbox"
                    id="readlist"
                    name="readlist"
                    value="paper"
                    checked={this.state.checked}
                    onChange={this.handleOnChange}
                />
            </div>
        )
    }
}

export default CheckBox;