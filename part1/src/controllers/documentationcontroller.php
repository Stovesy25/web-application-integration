<?php

/**
 * DocumentationController class
 * 
 * This class is used to set the content for the HTML documentation page.
 * 
 * @author Graham Stoves, w19025672
 */

class DocumentationController extends Controller
{
    /**
     *processRequest 
     *
     * A new page is created and the contents are passed into the documentation * page variable
     *
     * @param string $nav - holds the current URL to be passed to the href of
     * the nav link
     * @param string $documentationPage - holds the contents of the
     * documentation page
     *
     * @return string
     */

    protected function processRequest()
    {
        $nav = BASEPATH;
        $documentationPage = new DocumentationPage(
            "Documentation",
            ["Home" => $nav .= "", "Documentation" => "documentation"],
            "Documentation",
            "Graham Stoves - w19025672"
        );

        $documentationPage->apiDocumentation(
            "api",
            "http://unn-w19025672.newnumyspace.co.uk/kf6012/coursework/part1/api",
            "http://unn-w19025672.newnumyspace.co.uk/kf6012/coursework/part1/api",
            "Supported Methods",
            "Only supports GET requests.",
            "Endpoint Description",
            "The api endpoint displays the student's name, id, description of the endpoint and a link to the documentation page.",
            "Supported Parameters",
            "No additional parameters are supported for this endpoint.",
            "HTTP Status Codes",
            "200 - Returns 'Ok' if valid results are returned<br>
          405 - Only accepts GET requests, 405 is returned if any other request is sent <br>
          500 - Returned if there is a problem with the server",
            "Request Example",
            "http://unn-w19025672.newnumyspace.co.uk/kf6012/coursework/part1/api",
            "Response Example",
            '
         "message": "Ok",
         "status": 200,
         "count": 3,
         "results": {
            "student":
               "name": "Graham Stoves",
               "id": "w19025672",
            "message": "This API displays the students name, student ID and a link to the documentation page.",
            "documentation": "The API documentation can be found via this page: http:\/\/localhost\/kf6012\/coursework\/part1\/documentation"}'
        );

        $documentationPage->apiDocumentation(
            "authors",
            "http://unn-w19025672.newnumyspace.co.uk/kf6012/coursework/part1/api/authors",
            "http://unn-w19025672.newnumyspace.co.uk/kf6012/coursework/part1/api/authors",
            "Supported Methods",
            "Only supports GET requests.",
            "Endpoint Description",
            "The authors endpoint displays the author's name and id.",
            "Supported Parameters",
            "id - Returns the individual author associated with the ID <br>
          paperid - Finds a certain paper and lists all the authors associated with that paper",
            "HTTP Status Codes",
            "200 - Returns 'Ok' if valid results are returned <br>
          405 - Only accepts GET requests, 405 is returned if any other request is sent <br>
          404 - Returns 'No content' if there are no results <br>
          500 - Returned if there is a problem with the server",
            "Request Example",
            "http://unn-w19025672.newnumyspace.co.uk/kf6012/coursework/part1/api/authors?id=59952",
            "Response Example",
            '
         "message": "Ok",
         "status": 200, 
         "count": 1, 
         "results": [
         {
            "author_id": "59952",
            "first_name": "Afroditi",
            "middle_name": "",
            "last_name": "Psarra"
         }]'
        );

        $documentationPage->apiDocumentation(
            "papers",
            "http://unn-w19025672.newnumyspace.co.uk/kf6012/coursework/part1/api/papers",
            "http://unn-w19025672.newnumyspace.co.uk/kf6012/coursework/part1/api/papers",
            "Supported Methods",
            "Only supports GET requests.",
            "Endpoint Description",
            "The papers endpoint displays the paper's id, title, abstract, award_name, award_type_id and doi.",
            "Supported Parameters",
            "id - Returns the individual paper associated with the ID <br>
          authorid - Finds a certain author and lists all the papers associated with that author <br>
          random=true - Finds a random paper <br>
          award=all - Finds all the papers that have won awards",
            "HTTP Status Codes",
            "200 - Returns 'Ok' if valid results are returned <br>
          405 - Only accepts GET requests, 405 is returned if any other request is sent <br>
          404 - Returns 'No content' if there are no results <br>
          500 - Returned if there is a problem with the server",
            "Request Example",
            "http://unn-w19025672.newnumyspace.co.uk/kf6012/coursework/part1/api/papers?id=60107",
            "Response Example",
            '
         "message": "Ok",
         "status": 200,
         "count": 1,
         "results": [
            {
               "paper_id": "60107", 
               "title": "Moving Design Research: GIFs as Research Tools",
               "abstract": "Animated GIFs are often viewed as a nod to early internet culture or as tools for digital communication, but in this pictorial, we highlight a new use of GIFs, as tools for design research. We walk through four case studies from our own research that exemplify GIFs used throughout the design process as empirical probes, prototypes, communication tools, and finalized artifacts. By conducting a collaborative, reflexive analysis of these cases, we present an annotated portfolio of the goals, crafting and aesthetic choices of our GIFs and how creating GIFs added to our research. We conclude by noting that both the aesthetics of movement and the rich, concise, and contextualized nature of gifs added to our depth of thinking and ability to communicate speculative and imaginative concepts. Finally, we also suggest that research dissemination, especially for design research, would be enriched by supporting more diverse knowledge-production artifacts such as GIFs.",
               "award_name": "Best pictorial honourable mention",
               "award_type_id": "4",
               "doi": "https:\/\/dl.acm.org\/doi\/10.1145\/3461778.3462144"
            }
         ]'
        );

        $documentationPage->apiDocumentation(
            "authenticate",
            "http://unn-w19025672.newnumyspace.co.uk/kf6012/coursework/part1/api/authenticate",
            "http://unn-w19025672.newnumyspace.co.uk/kf6012/coursework/part1/api/authenticate",
            "Supported Methods",
            "Only supports POST requests.",
            "Endpoint Description",
            "The authenticate endpoint checks that the email and password are valid, and provides a JSON web token to the user if they are.",
            "Supported Parameters",
            "email - The email the user types in is checked to see if it is in the database <br>
          password - The password the user types in is checked to see if it is in the database",
            "HTTP Status Codes",
            "200 - Returns 'Ok' if valid results are returned <br>
          401 - Returns 'Unauthorised' if the email and password are not valid <br> 
          405 - Only accepts POST requests, 405 is returned if any other request is sent <br>
          500 - Returned if there is a problem with the server",
            "Request Example",
            '"email": "kay@example.com" <br>
         "password": "kaypassword"',
            "Response Example",
            '
         "message": "Ok",
         "status": 200,
         "count": 1,
         "results": {
               "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjIiLCJleHAiOjE2NTAwMzI5MjZ9.MnxCasUxBhqf5_4rn7Qrxtf_-tWi5ACTZs_EpuEvLl0"
         }'
        );

        $documentationPage->apiDocumentation(
            "readinglist",
            "http://unn-w19025672.newnumyspace.co.uk/kf6012/coursework/part1/api/readinglist",
            "http://unn-w19025672.newnumyspace.co.uk/kf6012/coursework/part1/api/readinglist",
            "Supported Methods",
            "Only supports POST requests.",
            "Endpoint Description",
            "The readinglist endpoint displays all the papers on the users reading list, allowing them to add or remove papers.",
            "Supported Parameters",
            "token - This is used to verify the user <br>
          add - Adds papers to the users reading list <br>
          remove - Removes papers from the users reading list",
            "HTTP Status Codes",
            "200 - Returns 'Ok' if valid results are returned <br>
          401 - Returns 'Unauthorised' if the token is not valid <br> 
          405 - Only accepts POST requests, 405 is returned if any other request is sent <br>
          500 - Returned if there is a problem with the server",
            "Request Example",
            '"token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjIiLCJleHAiOjE2NTAwMzI5MjZ9.MnxCasUxBhqf5_4rn7Qrxtf_-tWi5ACTZs_EpuEvLl0"',
            "Response Example",
            '
         "message": "Ok",
         "status": 200,
         "count": 2,
         "results": [
            {
               "paper_id": "60164"
            },
            {
               "paper_id": "60204"
            }
         ]'
        );
        return $documentationPage->generateWebpage();
    }
}