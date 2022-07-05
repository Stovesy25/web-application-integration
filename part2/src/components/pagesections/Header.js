import React from "react";
import { Link } from "react-router-dom";
import "./PageSections.css";

/**
 * Displays information in the header, including the navbar links
 * 
 * @author Graham Stoves, w19025672
 */

class Header extends React.Component {
    render() {
        return (
            <div>
                <header>
                    <nav>
                        <ul>
                            <li><Link to="/">Home</Link></li>
                            <li><Link to="paperspage">Papers</Link></li>
                            <li><Link to="authorspage">Authors</Link></li>
                            <li><Link to="readinglistpage">Reading List</Link></li>
                        </ul>
                    </nav>
                </header>
            </div>
        )
    }
}

export default Header;