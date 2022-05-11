import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useHistory } from 'react-router';
import './exam.css'
import Question from './question';
import Answers from './answers';
import { Button } from 'react-bootstrap';
import PreviewModal from '../../components/exam/PreviewModal';
import moment from 'moment';
import Timer from '../../config/Timer';





const Exam = () => {

    //check if current attended data exists

    let CurrentAttendedDataExists = false
    if(localStorage.getItem("current_attended_data")!==null){
       const CurrentAttendedData = JSON.parse(localStorage.getItem('current_attended_data'));
       CurrentAttendedDataExists = Object.keys(CurrentAttendedData).includes(encrypted_quiz_id);

    }
    //End check if current attended data exists


    //check if current page  data exists

    let CurrentPageDataExists = false
    if(localStorage.getItem("current_page_data")!==null){
       const CurrentPageData = JSON.parse(localStorage.getItem('current_page_data'));
       CurrentPageDataExists = Object.keys(CurrentPageData).includes(encrypted_quiz_id);

    }
    // End check if current page data exists


    //check if current exam mode exists

    let CurrentExamModeExists = false
    if(localStorage.getItem("current_mode_data")!==null){
        const CurrentExamMode = JSON.parse(localStorage.getItem('current_mode_data'));
        CurrentExamModeExists = Object.keys(CurrentExamMode).includes(encrypted_quiz_id);

    }
    // End check if current exam mode exists


    const history = useHistory();
    const [questionsAnswers, setQuestionAnswers] = useState([]);
    const [currentQid, setCurrentQid] = useState(null)
    const [error, setError] = useState(null);
    const [loadingApi, setLoadingApi] = useState(false);
    const [timeLoading, setTimeLoading] = useState(true)
    const [loading, setLoading] = useState(false);
    const [videoLoadError, setVideoLoadError] = useState(false);
    const [buttonTimer, setButtonTimer] = useState(null);
    const [timeOver, setTimeOver] = useState(false);
    const [currentPage, setCurrentPage] = !CurrentPageDataExists? useState(1) : useState(JSON.parse(localStorage.getItem('current_page_data'))[encrypted_quiz_id]["page_no"]);  
    const [examMode, setExamMode] = !CurrentExamModeExists? useState("exam") : useState(JSON.parse(localStorage.getItem('current_mode_data'))[encrypted_quiz_id]["mode"])//exam, preview, edit modes
    const [QuestionPerPage] = useState(1);
    const [showPreviewModal, setShowPreviewModal] = useState(examMode=="preview" ? true : false);
    const [attendedQuizzes, setAttendedQuizzes] = !CurrentAttendedDataExists? useState({}) : useState(JSON.parse(localStorage.getItem('current_attended_data'))[encrypted_quiz_id]["attended"]);  


    useEffect(() => {
        if(!timeOver) return;
        if(!timeLoading && timeOver) {
            if(currentPage == totalQuestions){
                PreviewHandler()
            }else{
                GotoNextVideoHandler()
            }

        }

    },[timeLoading, timeOver])
    
    //Store attended quiz to local storage if not present
    let current_attended_data = null;
    
    const is_current_attended_data_present = localStorage.getItem("current_attended_data")==null  ?true:false;

    if(is_current_attended_data_present){
        current_attended_data = {
           ...JSON.parse(localStorage.getItem('current_attended_data')),
           [encrypted_quiz_id] : {
                "attended": attendedQuizzes
           }
       }
       localStorage.setItem('current_attended_data', JSON.stringify(current_attended_data));
    }else{
        const current_attended_data_storage = JSON.parse(localStorage.getItem('current_attended_data'));
        if(current_attended_data_storage[encrypted_quiz_id] !== null){
            current_attended_data = {
                ...JSON.parse(localStorage.getItem('current_attended_data')),
                [encrypted_quiz_id] : {
                     "attended": attendedQuizzes
                }
            }
            localStorage.setItem('current_attended_data', JSON.stringify(current_attended_data));
        }else{
            current_attended_data = {
                ...JSON.parse(localStorage.getItem('current_attended_data')),
                [encrypted_quiz_id] : {
                     "attended": attendedQuizzes
                }
            }
            localStorage.setItem('current_attended_data', JSON.stringify(current_attended_data));
        }


    }

    // End Store attended quiz to local storage if not present


    //  Store current page to local storage if not present
    let current_page_data = null;


    const is_current_page_data_present = localStorage.getItem("current_page_data")==null  ?true:false;

    if(is_current_page_data_present){
        current_page_data = {
           [encrypted_quiz_id] : {
                "page_no": currentPage
           }
       }
       localStorage.setItem('current_page_data', JSON.stringify(current_page_data));
    }else{
        const current_page_data_storage = JSON.parse(localStorage.getItem('current_page_data'));
        if(current_page_data_storage[encrypted_quiz_id] !== null){
            current_page_data = {
                [encrypted_quiz_id] : {
                     "page_no": currentPage
                }
            }
            localStorage.setItem('current_page_data', JSON.stringify(current_page_data));
        }else{
            current_page_data = {
                [encrypted_quiz_id] : {
                     "page_no": currentPage
                }
            }
            localStorage.setItem('current_page_data', JSON.stringify(current_page_data));
        }


    }
    // End Store current page to local storage if not present



    //  Store current mode to local storage if not present
    let current_mode_data = null;


        const is_current_mode_data_present = localStorage.getItem("current_mode_data")==null  ?true:false;
    
        if(is_current_mode_data_present){
            current_mode_data = {
               [encrypted_quiz_id] : {
                    "mode": examMode
               }
           }
           localStorage.setItem('current_mode_data', JSON.stringify(current_mode_data));
        }else{
            const current_mode_data_storage = JSON.parse(localStorage.getItem('current_mode_data'));
            if(current_mode_data_storage[encrypted_quiz_id] !== null){
                current_mode_data = {
                    [encrypted_quiz_id] : {
                         "mode": examMode
                    }
                }
                localStorage.setItem('current_mode_data', JSON.stringify(current_mode_data));
            }else{
                current_mode_data = {
                    [encrypted_quiz_id] : {
                         "mode": examMode
                    }
                }
                localStorage.setItem('current_mode_data', JSON.stringify(current_mode_data));
            }
    
    
        }


    // End Store current mode to local storage if not present




    // Fetch quiz

    const fetchQuiz = async () =>  {
        setLoadingApi(true);
        try{
            const response = await axios.get(`${exam_api_url}/${current_quiz.id}`);
            const resData = await response.data;
            setQuestionAnswers(resData.question_answers);
        }catch(error){
            setLoadingApi(false);
            setError(error.response.data.message);
        }
        setLoadingApi(false);
    }

    useEffect(() => {
        fetchQuiz();
    }, [])

    //End Fetch quiz



    //pagination
    const totalQuestions = questionsAnswers.length;

    const indexOfLastQuestion = currentPage * QuestionPerPage;
    const indexOfFirstQuestion = indexOfLastQuestion - QuestionPerPage;
    const currentQuestionAnswers = questionsAnswers.slice(indexOfFirstQuestion, indexOfLastQuestion);
    
    // Change page
    const paginate = pageNumber => {
        setCurrentPage(pageNumber);
    } 

    const pageNumbers = [];

    for (let i = 1; i <= Math.ceil(totalQuestions / QuestionPerPage); i++) {
        pageNumbers.push(i);
    }

    //End Pagination


        //Assign time to quiz if exist
        useEffect(() =>{
            if(examMode=="exam" && questionsAnswers.length>0){
                const currentQA = questionsAnswers.find((questionAnswers) => questionAnswers.id ==  currentQid)
                if(Object.keys(currentQA).length>0){ 
                    if(currentQA && currentQA.answers_show_status == 'timer'){
                        let CurrentQuestionTimerData = null;
                        CurrentQuestionTimerData = JSON.parse(localStorage.getItem('question_time'));
                        if(CurrentQuestionTimerData == null){
                            let questionTime = {
                                [encrypted_quiz_id] : {
                                        "question_time": moment().add(currentQA.time_of_answers,'minutes').format()
                                }
                            }
                            localStorage.setItem('question_time', JSON.stringify(questionTime));
                            CurrentQuestionTimerData = JSON.parse(localStorage.getItem('question_time'));
                        }
                        const questionTimeKey = CurrentQuestionTimerData ? Object.keys(CurrentQuestionTimerData).includes(encrypted_quiz_id): null;
                        if(!questionTimeKey){  
                            let questionTime = {
                                ...JSON.parse(localStorage.getItem("question_time")),
                                [encrypted_quiz_id] : {
                                        "question_time": moment().add(currentQA.time_of_answers,'minutes').format()
                                }
                            }
                            localStorage.setItem('question_time', JSON.stringify(questionTime));
                            CurrentQuestionTimerData = JSON.parse(localStorage.getItem('question_time'));
                            setButtonTimer(CurrentQuestionTimerData[encrypted_quiz_id]["question_time"])
                        }else{
                            setButtonTimer(CurrentQuestionTimerData[encrypted_quiz_id]["question_time"])
                        }
                        // setButtonTimer
                    }else{
                        setButtonTimer(null)
                    }

                }
            }
        },[currentQid])
    //End Assign time to quiz if exist


    //Change Video functions(Next Prev Submit)

    const loadErrorHandler = () => {
        window.location.reload();
        }

    const GotoPrevVideoHandler = () => {
        if(currentPage == 1){return;}
        setCurrentPage((prevState) => prevState - 1)
    }
    
    const GotoNextVideoHandler = () => {
        if(currentPage == totalQuestions){return;}
        const question_time = localStorage.getItem('question_time')
        let CurrentQATimeExists = false;
        const CurrentQATime = JSON.parse(question_time);
        CurrentQATimeExists = Object.keys(CurrentQATime).includes(encrypted_quiz_id);
        if(CurrentQATimeExists){
            delete(CurrentQATime[encrypted_quiz_id]);
            localStorage.setItem('question_time', JSON.stringify(CurrentQATime));
        }
        setButtonTimer(null);
        setCurrentPage((prevState) => prevState + 1)
    }

    // End Change Video functions(Next Prev Submit)


    //Attended object function

        const currentVisitedHandler = (qid) => {
            if(qid===undefined) return;
            setCurrentQid(qid)
               attendedQuizzes[qid]={
                 ...attendedQuizzes[qid],
                    qid,
                   visited: true,
                   currentPage: currentPage,
               }  
        }


        const answeringHandler = (event, qid, index) => {

            if(Object.keys(attendedQuizzes).includes(`${qid}`) !== -1){
                if(event.target.checked){
                    attendedQuizzes[qid] = {
                        ...attendedQuizzes[qid],
                        qid,
                        ans_id: event.target.value,
                        answered: true,
                        ans_index: index,
        
                    }
                }else{
                    attendedQuizzes[qid]["answered"] = false;
                    delete(attendedQuizzes[qid]["ans_id"]);
                    delete(attendedQuizzes[qid]["ans_index"]);
                }
            }
        }


    //End Attended object function


    //Preview quiz

        const PreviewHandler = () => {
            setExamMode("preview")
            setShowPreviewModal(true)
            const question_time = localStorage.getItem('question_time')
            let CurrentQATimeExists = false;
            const CurrentQATime = JSON.parse(question_time);
            CurrentQATimeExists = Object.keys(CurrentQATime).includes(encrypted_quiz_id);
            if(CurrentQATimeExists){
                delete(CurrentQATime[encrypted_quiz_id]);
                localStorage.setItem('question_time', JSON.stringify(CurrentQATime));
            }
            setButtonTimer(null);
        }

    //End Preview quiz


    //Modal Handlers

        const showPreviewModalHandler = () => {
            if(examMode == "exam"|| examMode == "edit"){ 
                setShowPreviewModal(true)
            }
        }

        const ClosePreviewModalHandler = () => {
            if(examMode == "preview"){ return;}
            setShowPreviewModal(false)
        }

    //End Modal Handlers


    //Edit Answer handler

       const EditAnswerHandler = (currentPage) => {
            if(currentPage==null){return;}
            setCurrentPage(currentPage);
            setExamMode("edit")
            setShowPreviewModal(false)
       }

    //End edit handler

    return (
        // <p>This is the exam page</p>
        <>
            {<PreviewModal 
            EditAnswerHandler={EditAnswerHandler}
            examMode={examMode}
            show={showPreviewModal} 
            handleClose={ClosePreviewModalHandler} 
            handleOpen={showPreviewModalHandler}
            questionsAnswers={questionsAnswers}
            attendedQuizzes={attendedQuizzes}
            />}
            <div className="row">
                <div className="col-lg-12">
                    <div style={{display: 'flex', justifyContent: 'space-between'}}>
                        <h5 className="quiz-intro-heading">Video - {currentPage}</h5>
                        {buttonTimer && <><Timer setTimeOver={setTimeOver} setTimeLoading={setTimeLoading} quizTimer={buttonTimer}/></>}
                    </div>
                </div>
            </div>

            <div className="row">
                <div className="col-lg-12">

                    
                        <Question 
                        currentQuestionAnswers={currentQuestionAnswers}
                        loading={loading}
                        videoLoadError={videoLoadError}
                        setLoading={setLoading}
                        setVideoLoadError={setVideoLoadError}
                        loadErrorHandler={loadErrorHandler}
                        currentVisitedHandler={currentVisitedHandler}
                        />
                        <div style={{display: 'flex', flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center'}}>
                            <p style={{marginTop: 20, marginLeft: 10}} className="quiz-intro-heading">Choose your answer below.</p>
                            <div>
                                <Button onClick={GotoPrevVideoHandler} variant="warning"><i className="las la-arrow-left"></i> Go to previous video</Button>
                                <Button 
                                disabled={examMode == "preview" ? true : false} 
                                onClick={currentPage == totalQuestions || examMode == "edit"? PreviewHandler : GotoNextVideoHandler} 
                                variant="primary">
                                    {currentPage == totalQuestions || examMode == "edit"? "Preview your answers" : "Go to next video"} <i className="las la-arrow-right"></i>
                                </Button>
                            </div>
                        </div>


                        <Answers 
                        answeringHandler={answeringHandler}
                        attendedQuizzes={attendedQuizzes}
                        currentQuestionAnswers={currentQuestionAnswers}/>
                </div>
            </div>

        </>
    )
}


export default Exam;
