import React from "react";
import "../MainPages.css";

/**
 * Displays a search box on the papers and author page
 *
 * @var this.props.placeholder - holders the placeholder text within the 
 * searchbox
 * @var this.props.search - holds the value the user types in
 *
 * @method this.props.handleSearch - when a user types in box this method is 
 * called 
 * 
 * @author Graham Stoves, w19025672
 */

class SearchBox extends React.Component {

    render() {
        return (
            <input type='text' placeholder={this.props.placeholder} value={this.props.search} onChange={this.props.handleSearch} />
        )
    }
}

export default SearchBox;