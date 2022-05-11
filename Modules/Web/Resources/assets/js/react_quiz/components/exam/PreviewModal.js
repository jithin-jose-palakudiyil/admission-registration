import axios from 'axios';
import React, { useState } from 'react';
import { Button, Modal, Spinner } from 'react-bootstrap';
import YouTube from 'react-youtube';
import VideoErrorOrLoading from '../../config/components/VideoErrorOrLoading';


const PreviewModal = ({handleClose, show, questionsAnswers, attendedQuizzes, EditAnswerHandler, examMode}) => {



    const [loading, setLoading] = useState(false);
    const [videoLoadError, setVideoLoadError] = useState(false);
    const [loadingSubmitApi, setLoadingSubmitApi] = useState(false);

    const opts = {
        height: '500',
        width: '100%',
        playerVars: {
            autoplay: 0,
            rel: 0
        },
      };



      const CheckVideoLoadError = () => {
        setLoading(false)
      setVideoLoadError(true)
    }


    const checkVideoLoadReady = () => {
        setVideoLoadError(false)
      setLoading(false)
  }


  const loadErrorHandler = () => {
    window.location.reload();
    }


    const handleSubmit = async () => {
        setLoadingSubmitApi(true)
        try{
            const response = await axios.get(`${submit_quiz_url}/${encrypted_quiz_id}`)
            const resData = await response.data
            if(resData.status == true){

                window.location.replace(dashboard_url);

            }
            setLoadingSubmitApi(false)
        }catch(error){
            console.log(error);
        }
        setLoadingSubmitApi(false)
    }


    return (
        <>

        <Modal size="lg" show={show} onHide={handleClose}>
            <Modal.Header closeButton={examMode == ("exam" || "edit") ? true:false}>
                <Modal.Title style={{display: 'block', margin: 'auto', fontSize: 22}}>Preview & Edit Your Answers</Modal.Title>
            </Modal.Header>
            <Modal.Body>
                <div>
                    {questionsAnswers.map((question, questionIndex) => {
                        let is_selected_key = false;
                        const selectedKey = attendedQuizzes[question.id];
                        if(typeof(selectedKey) !== 'undefined'){
                            is_selected_key = true
                        }else{
                            return;
                        }
                        let correct_answer = null;
                        return (
                            <div key={question.id} style={{ marginBottom: 10}} className="row">
                                <p style={{marginLeft: 12}} className="quiz-intro-heading">Question - {questionIndex + 1}</p>
                                    {
                                        question && question.question!=null?
                                        <div className="col-lg-12">
                                        <p className="modal-question"><span style={{color: '#51be72'}}>Q.  </span>{question.question}</p></div>:
                                        <>
                                        <div className={videoLoadError?"player-container-hidden col-lg-12" : "player-container col-lg-12"} style={{height: 500, width: '100%'}}>
                                            <YouTube videoId={question.question_youtube_id} opts={opts} onReady={checkVideoLoadReady} onError={CheckVideoLoadError} />
                                        </div> 
                                        <div className="video-container">
                                            {!loading && videoLoadError && 
                                            <VideoErrorOrLoading type="error" imageUrl={VideoLoadErrorImageUrl}>
                                                    <small onClick={loadErrorHandler} className="badge badge-light-success font-13 mt-1 badge-custom">
                                                        Refresh page <i className="las la-arrow-right"></i>
                                                    </small> 
                                            </VideoErrorOrLoading> 
                                            }
                                        </div>
                                        </>
                                    }
                                
                                <div className="col-lg-12">
                                    {/* <p style={{marginLeft: 12, marginTop: 5, fontSize: 16, textTransform: 'capitalize'}} className="quiz-intro-heading">Answers</p> */}
                                    <div className="answer-area-container">
                                        <ol type="a" style={{ marginTop: 10}}>
                                        {question.answers.map(answer => {
                                            const is_answered = is_selected_key && typeof(selectedKey.answered) !== 'undefined' && 
                                            selectedKey.answered == true && selectedKey.ans_id == answer.id
                                            if(is_answered){
                                                correct_answer = answer.answer;
                                            }
                                            return (
                                                <li className={'modal-answer'} key={answer.id}>{answer.answer}</li>
                                            )
                                        })}
                                        </ol>
                                        <p onClick={()=> EditAnswerHandler(is_selected_key? selectedKey.currentPage :null)} 
                                        className="modal-answer edit-answer-text">Edit your answer <i className="las la-edit"></i></p>
                                    </div>   
                                    <div style={{marginTop: 4}}>
                                        {
                                            is_selected_key && (typeof(selectedKey.answered) == 'undefined' || selectedKey.answered == false)?
                                            <p className={"modal-answer"} style={{marginLeft: 22, color: 'red'}}> Not Answered !  </p> :
                                            correct_answer!=null ? <><p className={"modal-answer"} style={{marginLeft: 22}}> Your answer: <span className="your-answer">{correct_answer}</span>  </p>
                                            </>
                                            :null
                                        }
                                    </div>
                                </div>
                            </div>
                        )                        
                    })}
                </div>
            </Modal.Body>
            <Modal.Footer>
                {examMode == ("exam" || "edit") && <Button variant="secondary" onClick={handleClose}>
                    Close
                </Button>}
                {
                    loadingSubmitApi?
                    <button style={{minWidth: 135}} disabled={true} className="btn btn-block goToQuizButton glow"> <Spinner animation="border" style={{color: 'white', width: 19.5, height: 19.5}} /></button> :                             
                    <button className="btn btn-block goToQuizButton glow" onClick={handleSubmit}>
                        Save Changes & Submit
                    </button>
                }
            </Modal.Footer>
        </Modal>
        </>
    )

}

export default PreviewModal
