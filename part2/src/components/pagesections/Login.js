import React from 'react';
import "./PageSections.css";

/**
 * Displays a log in form
 *
 * @var this.props.email - holds the email that the user types in
 * @var this.props.password - holds the password that the user types in
 *
 * @method this.props.handleEmail - when a user types their email, this method 
 * is called  
 * @method this.props.handlePassword - when a user types their password, this 
 * method is called  
 * @method this.props.handleLoginClick - when a user clicks submit, this method 
 * is called  
 * 
 * @author Graham Stoves, w19025672
 */

class Login extends React.Component {
    render() {
        return (
            <div className='loginContainer'>
                <form>
                    <h1>Login</h1>
                    <div>
                        <label>Email</label>
                        <input type='text' placeholder='Email' value={this.props.email} onChange={this.props.handleEmail} />
                    </div>
                    <div>
                        <label>Password</label>
                        <input type='password' placeholder='Password' value={this.props.password} onChange={this.props.handlePassword} />
                    </div>
                    <div>
                        <button onClick={this.props.handleLoginClick}>Log in</button>
                    </div>
                </form>
            </div>
        );
    }
}

export default Login;