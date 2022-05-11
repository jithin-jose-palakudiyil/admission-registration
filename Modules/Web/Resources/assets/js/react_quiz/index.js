import React from 'react';
import ReactDOM from 'react-dom';
import App from './app';
import {
    BrowserRouter as Router,
  } from "react-router-dom";



const root =  document.getElementById('root')


if(root){
    ReactDOM.render(
        <React.StrictMode>
            <Router>
                <App />
            </Router> 
        </React.StrictMode>,
        root
    );
}
