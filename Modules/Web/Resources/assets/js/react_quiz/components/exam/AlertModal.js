import axios from 'axios';
import React, { useState } from 'react';
import { Button, Modal, Spinner } from 'react-bootstrap';



const AlertModal = ({handleClose, show, body, title, proceed_text, examMode}) => {

    const [loadingSubmitApi, setLoadingSubmitApi] = useState(false);



    const handleSubmit = async () => {
        setLoadingSubmitApi(true)
        try{
            const response = await axios.get(`${submit_quiz_url}/${encrypted_quiz_id}`)
            const resData = await response.data
            if(resData.status == true){
                window.location.replace(dashboard_url);

                
                const current_page_data = localStorage.getItem('current_page_data')
                let CurrentPageDataExists = false;
                const CurrentPageData = JSON.parse(current_page_data);
                if(typeof(CurrentPageData)!="undefined" && CurrentPageData!=null){
                    CurrentPageDataExists = Object.keys(CurrentPageData).includes(encrypted_quiz_id);
                    if(CurrentPageDataExists){
                        delete(CurrentPageData[encrypted_quiz_id]);
                        localStorage.setItem('current_page_data', JSON.stringify(CurrentPageData));
                    }
                }

                const current_mode_data = localStorage.getItem('current_mode_data')
                let CurrentModeDataExists = false;
                const CurrentModeData = JSON.parse(current_mode_data);
                if(typeof(CurrentModeData)!="undefined" && CurrentModeData!=null){
                    CurrentModeDataExists = Object.keys(CurrentModeData).includes(encrypted_quiz_id);
                    if(CurrentModeDataExists){
                        delete(CurrentModeData[encrypted_quiz_id]);
                        localStorage.setItem('current_mode_data', JSON.stringify(CurrentModeData));
                    }
                }


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
            setLoadingSubmitApi(false)
        }catch(error){
            console.log(error);
        }
        setLoadingSubmitApi(false)
    }


  
    return (
        <>

        <Modal backdrop="static" size="sm" centered show={show}>
            <Modal.Header>
                <Modal.Title style={{display: 'block', margin: 'auto'}}>{title}</Modal.Title>
            </Modal.Header>
            <Modal.Body>
                    {body}
            </Modal.Body>
            <Modal.Footer>         
                {loadingSubmitApi?
                    <Button style={{minWidth: 80}} disabled={true} className="btn btn-block goToQuizButton glow"> <Spinner animation="border" style={{color: 'white', width: 19.5, height: 19.5}} /></Button> :   
                    <Button className="btn btn-block goToQuizButton glow" onClick={handleSubmit}>
                        {proceed_text}
                    </Button>
                }
            </Modal.Footer>
        </Modal>
        </>
    )

}

export default AlertModal
