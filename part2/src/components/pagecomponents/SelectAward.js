import React from "react";
import "../MainPages.css";

/**
 * Displays a select box on the papers page to allow user to filter based on 
 * the award that the paper has won
 *
 * @var this.props.award_type_id - holds the award type id
 *
 * @method this.props.handleAwardSelect - when a user selects an option in the 
 * select list, this method is called  
 * 
 * @author Graham Stoves, w19025672
 */

class SelectAward extends React.Component {
    render() {
        return (
            <div>
                <select value={this.props.award_type_id} onChange={this.props.handleAwardSelect}>
                    <option value="">All papers</option>
                    <option value="1">Best Paper</option>
                    <option value="2">Best paper honourable mention</option>
                    <option value="3">Best pictorial</option>
                    <option value="4">Best pictorial honourable mention</option>
                    <option value="5">Special recognition for diversity and inclusion</option>
                </select>
            </div >
        )
    }
}

export default SelectAward;