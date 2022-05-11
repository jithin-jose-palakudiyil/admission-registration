import React from 'react';
import { Button, Spinner } from 'react-bootstrap';


const NextButtonIntro = ({clickHandler}) => {
    return (
        <div className="NextButton">
            <div></div>
            <div className="form-group mb-0 text-center ">
                <button onClick={clickHandler} className="btn btn-block goToQuizButton glow">{current_quiz.button_text} <i className="las la-arrow-right"></i></button>                              
            </div>
        </div>

    
)
}


export default NextButtonIntro;
