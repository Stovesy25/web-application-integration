import React from "react";
import "./PageSections.css";

/**
 * Displays information in the footer
 *
 * @author Graham Stoves, w19025672
 */

class Footer extends React.Component {
    render() {
        return (
            <div>
                <footer>
                    <p>Graham Stoves</p>
                    <p>Student ID: w19025672</p>
                    <p>This is university coursework and not associated with or endorsed by the DIS conference.</p>
                </footer>
            </div>
        )
    }
}

export default Footer;