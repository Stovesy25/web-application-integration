import React from 'react';
import "./PageSections.css";

/**
 * Displays a logout button
 * 
 * @method this.props.handleLogoutlick - when a user clicks logout, this method 
 * is called  
 * 
 * @author Graham Stoves, w19025672
 */

class Logout extends React.Component {
    render() {
        return (
            <div className='logoutContainer'>
                <button
                    className="logoutButton"
                    onClick={this.props.handleLogoutClick}
                >
                    Logout
                </button>
            </div>
        )
    }
}

export default Logout;