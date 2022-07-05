import React from "react";
import "./MainPages.css";

/**
 * Displays the error page
 * 
 * This page displays an error if the user types in an invalid page.
 *
 * @author Graham Stoves, w19025672
 */

class ErrorPage extends React.Component {
    render() {
        return (
            <div className="errorContainer">
                <h1>404 error</h1>
                <h2>This page doesn't exist.</h2>
            </div>
        )
    }
}

export default ErrorPage