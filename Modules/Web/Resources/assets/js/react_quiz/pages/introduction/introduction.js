import React, { useEffect, useState } from 'react';
import YouTube from 'react-youtube';
import moment from 'moment'
import Timer from '../../config/Timer';
import './introduction.css'
import { useHistory } from 'react-router';
import { routes } from '../../config/routes.constants';
import NextButtonIntro from '../../components/introduction/NextButtonIntro';
import Player from '../../config/components/player';
import axios from 'axios'
import AlertModal from '../../components/introduction/AlertModal';



const Introduction = () => {

    //got current_quiz from blade script
    const history = useHistory();
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(null);
    const [videoLoadError, setVideoLoadError] = useState(false);
    const [buttonTimer, setButtonTimer] = useState(null);
    const [timeOver, setTimeOver] = useState(false);
    const [timeLoading, setTimeLoading] = useState(true);
    const [loadingApi, setLoadingApi] = useState(false);
    const [showAlertModal, setShowAlertModal] = useState(false);





    useEffect(() => {
            setLoading(true)
            if(current_quiz && current_quiz.btn_show_status == 'timer'){
                let CurrentIntroTimerData = null;
                CurrentIntroTimerData = JSON.parse(localStorage.getItem('intro_time'));
                if(CurrentIntroTimerData == null){
                    let IntroTime = {
                        [encrypted_quiz_id] : {
                             "intro_time": moment().add(current_quiz.time_of_btn,'minutes').format()
                        }
                    }
                    localStorage.setItem('intro_time', JSON.stringify(IntroTime));
                    CurrentIntroTimerData = JSON.parse(localStorage.getItem('intro_time'));
                }
                const IntroTimeKey = CurrentIntroTimerData ? Object.keys(CurrentIntroTimerData).includes(encrypted_quiz_id): null;
                if(!IntroTimeKey){  
                    let IntroTime = {
                        ...JSON.parse(localStorage.getItem("intro_time")),
                        [encrypted_quiz_id] : {
                             "intro_time": moment().add(current_quiz.time_of_btn,'minutes').format()
                        }
                    }
                    localStorage.setItem('intro_time', JSON.stringify(IntroTime));
                    CurrentIntroTimerData = JSON.parse(localStorage.getItem('intro_time'));
                    setButtonTimer(CurrentIntroTimerData[encrypted_quiz_id]["intro_time"])
                }else{
                    setButtonTimer(CurrentIntroTimerData[encrypted_quiz_id]["intro_time"])
                }
                // setButtonTimer
            }else{
                setButtonTimer(null)
            }


    }, [])







      const goToExamPageHandler = async () => {
            setLoadingApi(true);
            try{
                const response = await axios.get(`${start_exam_url}/${encrypted_quiz_id}`);
                const resData = await response.data;
                if(resData.status == true){
                    localStorage.removeItem('intro_time')
                    history.replace(routes.exam.path)
                }
            }catch(error){
                setLoadingApi(false);
                setError(error.response.data.message);
            }
            setLoadingApi(false);
      }


      const loadErrorHandler = () => {
            // localStorage.removeItem('intro_time')
            window.location.reload();
            // window.location.replace(dashboard_quiz_url);
      }


      const openAlertModalHandler = () => {
        setShowAlertModal(true)
      }

      const closeAlertModalHandler = () => {
          setShowAlertModal(false)
      }


      if(error){
          return (
                <div >
                        <img style={{maxHeight: 300, display: 'block', margin: 'auto'}} src={ErrorImageUrl} alt="" />
                        <h4 style={{marginTop: 25, textAlign: 'center'}}>Sorry some error occured !</h4>
                        <div style={{display: 'flex', alignItems: 'center', justifyContent: 'center'}}>
                            <div></div>
                                <small onClick={loadErrorHandler} className="badge badge-light-success font-13 mt-1 badge-custom">
                                    Go Back <i className="las la-arrow-right"></i>
                                </small> 
                            <div></div>
                        </div>
                </div>
          )
      }

    return (
        <div>
            <AlertModal
                show={showAlertModal}
                handleClose={closeAlertModalHandler}
                handleSubmit={goToExamPageHandler}
                loadingApi={loadingApi}
                body={"ലോറെം ഇപ്‌സം ഡോളർ സിറ്റ് അമേറ്റ് കൺസെക്റ്റർ അഡിപിസിസിംഗ് എലിറ്റ്. മാക്സിം മോളിറ്റിയ,മോളസ്റ്റിയ ക്വാസ് വെൽ സിന്റ് കമ്മോഡി റിപ്പുഡിയാൻ‌ഡെ പരിണതഫലമായി വോളപ്റ്റാറ്റം ലേബർ നിഹിൽ‌, ഈവിയറ്റ് അലിക്വിഡ് കുൽ‌പ അഫീഷ്യ ഓട്ടോ! തടസ്സപ്പെടുത്തുക, സംസാരം, ഓഡിറ്റ്,"}
                title={"ശ്രദ്ധിക്കുക !"}
                proceed_text={"Proceed to exam"}
            />
            <div className="row">
                <div className="col-lg-12">
                    <div style={{display: 'flex', justifyContent: 'space-between'}}>
                        <h5 className="quiz-intro-heading question-box">{current_quiz.name} - Introduction</h5>
                        {buttonTimer && <><Timer style={{display: 'none'}} setTimeLoading={setTimeLoading} setTimeOver={setTimeOver} quizTimer={buttonTimer}/></>}
                    </div>
                </div>
            </div>
            <div className="row">
                    <Player 
                    type="intro"
                    videoId={current_quiz.video_id} 
                    loading={loading}
                    loadErrorHandler={loadErrorHandler}
                    setLoading={setLoading}
                    setVideoLoadError={setVideoLoadError}
                    videoLoadError={videoLoadError}
                    />
            </div>


            {/* If there is time  */}
            {!loading  && !videoLoadError &&  buttonTimer!=null  && timeOver && <NextButtonIntro clickHandler={openAlertModalHandler}/> }  

            {/* If there is not time */}
            {!loading && !videoLoadError  && buttonTimer==null && <NextButtonIntro clickHandler={openAlertModalHandler}/>}


        </div>

    )
}


export default Introduction;
