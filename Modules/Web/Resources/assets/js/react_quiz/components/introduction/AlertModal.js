import React, { useState } from 'react';
import { Button, Modal, Spinner } from 'react-bootstrap';



const AlertModal = ({handleClose, show, handleSubmit, loadingApi, body, title, proceed_text}) => {



    const [loading, setLoading] = useState(false);
  
    return (
        <>

        <Modal size="lg" centered show={show} onHide={handleClose}>
            <Modal.Body style={{overflowX: 'auto'}}>
                    <img style={{display:'block', margin:'auto', overflow: 'auto', maxHeight: 700, width: '100%'}} src={InfoImageUrl} /> 
            </Modal.Body>
            <Modal.Footer>
                <Button variant="secondary" className="btn btn-block goToQuizButton-secondary" onClick={handleClose}>
                    Close
                </Button>
         
                {loadingApi?
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
