import React from "react";
import "../MainPages.css";

/**
 * Displays a select box on the reading list page to allow user to filter based 
 * on whether the paper is in their list or not
 *
 * @var this.props.selectedReadingList - holds the value to be passed to the 
 * reading list page
 *
 * @method this.props.handleReadingList - when a user selects an option in the 
 * select list, this method is called  
 * 
 * @author Graham Stoves, w19025672
 */

class SelectList extends React.Component {
    render() {
        return (
            <div>
                <select value={this.props.selectedReadingList} onChange={this.props.handleReadingList}>
                    <option value="0">All papers</option>
                    <option value="1">My papers</option>
                </select>
            </div >
        )
    }
}

export default SelectList;