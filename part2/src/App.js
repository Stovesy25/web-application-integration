import React from 'react';
import { HashRouter, Routes, Route } from 'react-router-dom';
import './App.css';
import Header from './components/pagesections/Header.js';
import Footer from './components/pagesections/Footer.js';
import HomePage from './components/HomePage.js';
import PapersPage from './components/PapersPage.js';
import AuthorsPage from './components/AuthorsPage.js';
import ReadingListPage from './components/ReadingListPage.js';
import ErrorPage from './components/ErrorPage.js';

function App() {
    return (
        <HashRouter>
            <Header />
            <div>
                <Routes>
                    <Route path="/" element={<HomePage />} />
                    <Route path="paperspage" element={<PapersPage />} />
                    <Route path="authorspage" element={<AuthorsPage />} />
                    <Route path="readinglistpage" element={<ReadingListPage />} />
                    <Route path="*" element={<ErrorPage />} />
                </Routes>
                <Footer />
            </div>
        </HashRouter>
    );
}

export default App;
