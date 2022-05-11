import React, { useEffect, useState } from 'react';
import Player from '../../config/components/player';


const Question = ({
    // currentVisitedHandler,
    currentQuestionAnswers, 
    loadErrorHandler, 
    loading, 
    setVideoLoadError,
    setLoading,
    setCurrentQid,
    videoLoadError}) => {


        const [shiftedQA, setShiftedQA] = useState(null);

        useEffect(() => {
            if(typeof(currentQuestionAnswers) != 'undefined' && currentQuestionAnswers.length > 0) {
                const question = currentQuestionAnswers.shift()
                setShiftedQA(question);
                setCurrentQid(question.id)
                // currentVisitedHandler(question.id)
            }
        },[currentQuestionAnswers])



    return (


        <div className="row">
                {

               shiftedQA != null && 
               <>
                            <Player
                            type="exam"
                            key={shiftedQA.id} 
                            videoId={shiftedQA.question_youtube_id} 
                            loading={loading}
                            loadErrorHandler={loadErrorHandler}
                            setLoading={setLoading}
                            setVideoLoadError={setVideoLoadError}
                            videoLoadError={videoLoadError}
                            />
                            {
                                shiftedQA && shiftedQA.question!=null?
                                <p style={{marginTop: 25, fontSize: 24, color: 'black', fontWeight: 400}} className="modal-question"><span style={{color: '#51be72'}}>Q.  </span>{shiftedQA.question}</p>:null
                            }
                </>
          
                }
        </div>
    )
}

export default Question;
