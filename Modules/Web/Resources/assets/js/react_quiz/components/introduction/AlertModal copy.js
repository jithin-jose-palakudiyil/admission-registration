import React, { useState } from 'react';
import { Button, Modal, Spinner } from 'react-bootstrap';



const AlertModal = ({handleClose, show, handleSubmit, loadingApi, body, title, proceed_text}) => {



    const [loading, setLoading] = useState(false);
  
    return (
        <>

        <Modal size="lg" centered show={show} onHide={handleClose}>
            <Modal.Header style={{textAlign:'center', display: 'block'}}>
                <Modal.Title className="malayalam-font-notification-title">MGM - MEL Online Scholarship <span style={{fontSize: 30}}>പരീക്ഷയിൽ പങ്കെടുക്കുന്ന വിധം</span></Modal.Title>
            </Modal.Header>
            <Modal.Body>
                    <ol type="1">
                        <li className="malayalam-font-notification-content">ഇൻറർനെറ്റ് കണക്റ്റിവിറ്റി ഡി സ്കണക്റ്റ് ആവാതിരിക്കാൻ പ്രത്യേകം ശ്രദ്ധിക്കുക.</li>
                        <li className="malayalam-font-notification-content">ചുവടെയുള്ള <span>"Click here to start Exam"</span> എന്ന ബട്ടണിൽ അമർത്തി പരീക്ഷയിൽ പ്രവേശിക്കുക.</li>
                        <li className="malayalam-font-notification-content">ആകെ 25 ചോദ്യങ്ങൾ ആണ് ഉള്ളത്. ശ്രദ്ധിച്ച് എല്ലാ ചോദ്യങ്ങൾക്കും ഉത്തരം നൽകി <span>"Submit Now"</span> ബട്ടണിൽ അമർത്തി പരീക്ഷ വിജയകരമായി പൂർത്തീകരിക്കുക.</li>
                        <li className="malayalam-font-notification-content">ഉത്തരം രേഖപ്പെടുത്തി അടുത്ത ചോദ്യത്തിലേക്ക് പോയതിനു ശേഷം ഉത്തരം മാറ്റം വരുത്താൻ സാധിക്കുന്നതല്ല.</li>
                        <li className="malayalam-font-notification-content">പരീക്ഷാസമയത്ത് നിങ്ങളുടെ ബ്രൗസർ വിൻഡോ ക്ലോസ് ചെയ്യരുത്.</li>
                        <li className="malayalam-font-notification-content">നിശ്ചിത സമയത്തിനുള്ളിൽ <span>(40 Sec)</span> ഓരോ ചോദ്യത്തിനും ഉത്തരം രേഖപ്പെടുത്തുക. അല്ലാത്തപക്ഷം അടുത്ത ചോദ്യത്തിലേക്ക് പോകുന്നതാണ്.</li>
                        <li className="malayalam-font-notification-content">ഓരോ വിഡിയോയും മുഴുവനായും കാണുക. വീഡിയോ ബഫർ ചെയ്യാൻ താമസം നേരിട്ടാൽ അതാതു വീഡിയോയുടെ ചുവടെ ഉള്ള ചോദ്യങ്ങൾ വായിച്ചതിനുശേഷം ഉത്തരം രേഖപ്പെടുത്തുക.</li>
                    </ol>
                 
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
