import React from "react";
import image from './img/paper_img.jpg';

/**
 * Displays the homepage
 * 
 * This page displays an image and a random paper.
 *
 * @var this.state.paper.title - the title of the paper 
 * @var this.state.paper.abstract - the abstract of the paper 
 * @var this.state.paper.award_name - the award name of the paper
 *
 * @author Graham Stoves, w19025672
 */

class HomePage extends React.Component {
    constructor(props) {
        super(props)
        this.state = {
            paper: "",
        }
    }

    componentDidMount() {
        // finds a random paper in the database
        fetch("http://unn-w19025672.newnumyspace.co.uk/kf6012/coursework/part1/api/papers?random=true")
            .then(response => {
                if (response.status === 200) {
                    return response.json()
                } else {
                    throw Error(response.statusText)
                }
            })
            .then(data => {
                this.setState({
                    paper: data.results[0]
                })
            })
            .catch(err => {
                console.log("something went wrong: ", err)
            })
    }

    render() {
        let noData = ""
        let awardName = this.state.paper.award_name

        // if the paper does not have an award, instead of displaying 'null', displays 'no award'
        if (awardName === null) {
            awardName = <p>No award</p>
        }

        if (this.state.results === null) {
            noData = <p>No data</p>
        }

        return (
            <div className="mainContainer">
                {noData}
                <img src={image} className="paperImg" alt="logo" />
                <div className="captionOverlay">Photo by <a href="https://unsplash.com/@anniespratt?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Annie Spratt</a> on <a href="https://unsplash.com/s/photos/papers?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a></div>
                <div className="paperContainer">
                    <h1>Paper of The Day</h1>
                    <h2>Title</h2><p>{this.state.paper.title}</p>
                    <h2>Abstract</h2><p>{this.state.paper.abstract}</p>
                    <h2>Award</h2><p>{awardName}</p>
                </div>
            </div>
        )
    }
}

export default HomePage;