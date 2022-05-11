import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useHistory } from 'react-router';
import './exam.css'
import Question from './question';
import Answers from './answers';
import { Button, Spinner } from 'react-bootstrap';
import PreviewModal from '../../components/exam/PreviewModal';
import moment from 'moment';
import Timer from '../../config/Timer';
import AlertModal from '../../components/exam/AlertModal';




const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const config = {
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': token
    }
  };



const Exam = () => {


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
    const [reviewQuiz] = useState(typeof(current_quiz)!="undefined" && current_quiz.review_quiz!=null? current_quiz.review_quiz:null);
    const [currentQid, setCurrentQid] = useState(null)
    const [error, setError] = useState(null);
    const [loadingQAfetchApi, setLoadingQAfetchApi] = useState(false);
    const [loadingPreviewApi, setLoadingPreviewApi] = useState(false);
    const [loadingAttendApi, setLoadingAttendApi] = useState(false);
    const [timeLoading, setTimeLoading] = useState(true)
    const [loading, setLoading] = useState(false);
    const [videoLoadError, setVideoLoadError] = useState(false);
    const [buttonTimer, setButtonTimer] = useState(null);
    const [timeOver, setTimeOver] = useState(false);
    const [currentPage, setCurrentPage] = !CurrentPageDataExists? useState(1) : useState(JSON.parse(localStorage.getItem('current_page_data'))[encrypted_quiz_id]["page_no"]);  
    const [examMode, setExamMode] = !CurrentExamModeExists? useState("exam") : useState(JSON.parse(localStorage.getItem('current_mode_data'))[encrypted_quiz_id]["mode"])//exam, preview, edit, submit, modes
    const [QuestionPerPage] = useState(1);
    // const [showAlertModal, setShowAlertModal] = useState(reviewQuiz!=null && reviewQuiz==0 && examMode=="submit" ? true : false);
    const [showPreviewModal, setShowPreviewModal] = useState(reviewQuiz!=null && reviewQuiz==1 && examMode=="preview" ? true : false);
    const [attendedQuizzes, setAttendedQuizzes] = useState({})


    useEffect(() => {
        if(!timeOver) return;
        if(!timeLoading && timeOver) {
            if(currentPage == totalQuestions){
                if(reviewQuiz!=null && reviewQuiz==0){
                    SubmitExamDirect()
                    console.log("hello");
                    return;
                }
                PreviewHandler()
            }else{
                GotoNextVideoHandler()
            }

        }

    },[timeLoading, timeOver])

    
    

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
        setLoadingQAfetchApi(true);
        try{
            const response = await axios.get(`${exam_api_url}/${encrypted_quiz_id}`);
            const resData = await response.data;
            if(resData.status == true){
                setQuestionAnswers(resData.question_answers);
                if(resData.current_page!=null){
                    setCurrentPage(parseInt(resData.current_page));
                    setAttendedQuizzes(resData.attended);
                    if(resData.quiz_status == 1) {
                        window.location.replace(dashboard_url)
                        return;
                    }
                    if(resData.quiz_status == 2 && reviewQuiz!=null && reviewQuiz==1){
                        PreviewHandler();
                        setCurrentPage(parseInt(resData.current_page));
                    }else{
                        setExamMode("exam");
                    }
                }
            }
        }catch(error){
            if( typeof(error.response.data.type)!='undefined' && error.response.data.type == 'redirect'){
                window.location.replace(dashboard_url);
            }
            setLoadingQAfetchApi(false);
            setError(error.response.data.message);
        }
        setLoadingQAfetchApi(false);
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
        setButtonTimer(null);
        setCurrentPage(currentPage + 1)
        const question_time = localStorage.getItem('question_time')
        let CurrentQATimeExists = false;
        const CurrentQATime = JSON.parse(question_time);
        if(typeof(CurrentQATime)!="undefined" && CurrentQATime!=null){
            CurrentQATimeExists = Object.keys(CurrentQATime).includes(encrypted_quiz_id);
            if(CurrentQATimeExists){
                delete(CurrentQATime[encrypted_quiz_id]);
                localStorage.setItem('question_time', JSON.stringify(CurrentQATime));
            }
        }
    }

    // End Change Video functions(Next Prev Submit)


    //Attended object function



        useEffect(() => {
            let data = null
            if(loadingQAfetchApi) return;
            if(examMode == 'preview' || examMode == 'edit') return;
            const currentVisitedHandler = async () => {
                if(currentQid=== 'undefined'|| currentQid== null) return;
                try{
                     data = {
                        qid : currentQid,
                        currentPage,
                }
                    if(data.qid === 'undefined'|| data.qid == null) return;
                    setLoadingAttendApi(true)
                    if(Object.keys(attendedQuizzes).length>0){
                        const selectedKey = attendedQuizzes[data.qid];
                        if(typeof(selectedKey) !== 'undefined'){
                            if(typeof(selectedKey.answered) != 'undefined'){
                                data = {
                                    qid: currentQid,
                                    ans_id: selectedKey.answered==false?null:selectedKey.ans_id,
                                    currentPage,
                                    answered: selectedKey.answered,
                                }
                            }
                        }
                    }
                    const response = await axios.post(`${store_exam_data_url}/${encrypted_quiz_id}`, data, config);
                    const resData = await response.data;
                    if(resData.status == true){
                        setAttendedQuizzes(resData.attended)
                    }
                    setLoadingAttendApi(false)
                }catch(error){
                    setError(error.response.data.message);
                    setLoadingAttendApi(false)
                }
                setLoadingAttendApi(false)
            }

            currentVisitedHandler();
        },[currentQid])



        const answeringHandler = async (event, qid, index) => {
            if(qid===undefined) return;
            setLoadingAttendApi(true)
            let data = null;
            if(Object.keys(attendedQuizzes).includes(`${qid}`) !== -1){
                if(event.target.checked){
                     data = {
                        qid,
                        ans_id: event.target.value,
                        answered: true,
                        currentPage,
                }
                
            }else{
                     data = {
                        qid,
                        answered: false,
                        currentPage,
                    } 
                }
                try{
                    const response = await axios.post(`${store_exam_data_url}/${encrypted_quiz_id}`, data, config);
                    const resData = await response.data;
                    if(resData.status == true){
                        setAttendedQuizzes(resData.attended)
                    }
                    setLoadingAttendApi(false)
                }catch(error){
                    setError(error.response.data.message);
                    setLoadingAttendApi(false)

                }
                setLoadingAttendApi(false)
            }
        }


    //End Attended object function
    

    //Preview quiz

        const PreviewHandler = async () => {
            setLoadingPreviewApi(true)
            try{
                const response = await axios.get(`${preview_quiz_url}/${encrypted_quiz_id}`)
                const resData = await response.data
                if(resData.status == true){
                    setExamMode("preview")
                    setShowPreviewModal(true)
                    const question_time = localStorage.getItem('question_time')
                    let CurrentQATimeExists = false;
                    if(typeof(CurrentQATime)!="undefined" && CurrentQATime!=null){
                        const CurrentQATime = JSON.parse(question_time);
                        CurrentQATimeExists = Object.keys(CurrentQATime).includes(encrypted_quiz_id);
                        if(CurrentQATimeExists){
                            delete(CurrentQATime[encrypted_quiz_id]);
                            localStorage.setItem('question_time', JSON.stringify(CurrentQATime));
                        }
                    }
                    setButtonTimer(null);
                }
                setLoadingPreviewApi(false)
            }catch(error){
                console.log(error);
            }
            setLoadingPreviewApi(false)
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


        const SubmitExamDirect = async () => {
            setLoadingPreviewApi(true)
            try{
                const response = await axios.get(`${submit_quiz_url}/${encrypted_quiz_id}`)
                const resData = await response.data
                if(resData.status == true){
                    window.location.replace(dashboard_url)
                }
                setLoadingPreviewApi(false)
            }catch(error){
                console.log(error);
            }
            setLoadingPreviewApi(false)
  
        }


        // const CloseAlertModalHandler = () => {
        //     if(examMode == "submit"){ return;}
        //     setShowAlertModal(false)
        // }



    //End Modal Handlers


    //Edit Answer handler

       const EditAnswerHandler = (currentPage) => {
            if(currentPage==null){return;}
            setCurrentPage(currentPage);
            setExamMode("edit")
            setShowPreviewModal(false)
       }

    //End edit handler


    //Error component

    if(error){
        return (
              <div >
                      <img style={{maxHeight: 300, display: 'block', margin: 'auto'}} src={ErrorImageUrl} alt="" />
                      <h4 style={{marginTop: 25, textAlign: 'center'}}>Sorry some error occured !</h4>
                      <div style={{display: 'flex', alignItems: 'center', justifyContent: 'center'}}>
                          <div></div>
                              <small onClick={loadErrorHandler} className="badge badge-light-success font-13 mt-1 badge-custom">
                                  Reload page <i className="las la-arrow-right"></i>
                              </small> 
                          <div></div>
                      </div>
              </div>
        )
    }

    //End error component


    return (
        // <p>This is the exam page</p>
        <>
        {
            loadingQAfetchApi?
                <div style={{display: 'flex', alignItems: 'center', justifyContent: 'center', flexDirection: 'row'}}>
                <Spinner animation="border" variant="primary" />:
                </div>:
                <>
            {/* <AlertModal
                show={showAlertModal}
                handleClose={CloseAlertModalHandler}
                body={"Submit your exam!. We will keep you informed on any further updates. "}
                title={"Submit your exam"}
                proceed_text={"Submit now"}
                examMode = {examMode}
            /> */}
            {Object.keys(attendedQuizzes).length>0 && <PreviewModal 
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
                        <h5 className="quiz-intro-heading question-box">Question - {currentPage}</h5>
                        {buttonTimer && <><Timer setTimeOver={setTimeOver} setTimeLoading={setTimeLoading} quizTimer={buttonTimer}/></>}
                    </div>
                </div>
            </div>

            <div className="row">
                <div className="col-lg-12">

                    {/* <Spinner animation="border" style={{color: 'white', width: 19.5, height: 19.5}} /> */}
                        <Question 
                        currentQuestionAnswers={currentQuestionAnswers}
                        loading={loading}
                        videoLoadError={videoLoadError}
                        setLoading={setLoading}
                        setVideoLoadError={setVideoLoadError}
                        loadErrorHandler={loadErrorHandler}
                        setCurrentQid={setCurrentQid}
                        // currentVisitedHandler={currentVisitedHandler}
                        />
                        <div style={{display: 'flex', flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center'}}>
                            <div style={{position: 'relative'}}>
                                <p style={{marginTop: 20, marginLeft: 10, color: 'black', fontWeight: 600, fontSize: 20}} className="quiz-intro-heading answer-title-box">Choose your answer below.</p>
                                <div className="underline-answer-title"></div>
                            </div>
                            <div>
                                {/* <Button onClick={GotoPrevVideoHandler} variant="warning"><i className="las la-arrow-left"></i> Go to previous video</Button> */}
                                
                                {loadingPreviewApi && <button style={{minWidth: 185}} disabled={true} className="btn btn-block goToQuizButton glow"> <Spinner animation="border" style={{color: 'white', width: 19.5, height: 19.5}} /></button>}
                                
                                {loadingAttendApi && !loadingPreviewApi && <button style={{minWidth: 185}} disabled={true} className="btn btn-block goToQuizButton glow"> <Spinner animation="border" style={{color: 'white', width: 19.5, height: 19.5}} /></button>}
                                
                                {reviewQuiz!=null && reviewQuiz==1 && !loadingPreviewApi && !loadingAttendApi && <button 
                                disabled={examMode == "preview" || loadingPreviewApi || loadingQAfetchApi ? true : false} 
                                onClick={currentPage == totalQuestions || ( examMode == "edit")? PreviewHandler : GotoNextVideoHandler} 
                                className="btn btn-block goToQuizButton glow">
                                    {currentPage == totalQuestions || examMode == "edit"? "Preview your answers" : "Go to next question"} <i className="las la-arrow-right"></i>
                                </button>}
                                
                                {reviewQuiz!=null && reviewQuiz==0 && !loadingPreviewApi && !loadingAttendApi && <button 
                                disabled={examMode == "preview" || loadingPreviewApi || loadingQAfetchApi ? true : false} 
                                onClick={currentPage == totalQuestions? SubmitExamDirect : GotoNextVideoHandler} 
                                className="btn btn-block goToQuizButton glow">
                                    {currentPage == totalQuestions || examMode == "edit"? "Submit now" : "Go to next question"} <i className="las la-arrow-right"></i>
                                </button>}

                            </div>
                        </div>


                        <Answers 
                        examMode={examMode}
                        answeringHandler={answeringHandler}
                        attendedQuizzes={attendedQuizzes}
                        currentQuestionAnswers={currentQuestionAnswers}/>
                </div>
            </div>
            </>
        }

        </>
    )
}


export default Exam;
