import React, { useEffect } from 'react';
import $ from 'jquery';



const Answers = ({currentQuestionAnswers, answeringHandler, attendedQuizzes, examMode}) => {


    
    const HandleInputCheckMark = () => {
        $('.answer-list').on('change', function() {
            $('.answer-list').not(this).prop('checked', false);  
        });
    }

  useEffect(() => {
      HandleInputCheckMark();
      return () => {
        HandleInputCheckMark();
      }
  }, [HandleInputCheckMark])



    return (
        
        <div style={{display: 'flex', flexDirection: 'column'}} className="row">
            {
                currentQuestionAnswers.length>0 && 
                currentQuestionAnswers.map((answers) => {
                    let selectedKey = attendedQuizzes[answers.id]
                    return (
                        <div className="row" style={{marginLeft: 10, marginTop: 40}} key={answers.id}>
                        {answers.answers.map((answer, index) => {
                            return(
                                <div key={answer.id} className="col-lg-4">
                                <div className="form-group mb-3">
                                    <div className="custom-control custom-checkbox checkbox-info">
                                        <input 
                                        style={{fontSize: 18, cursor: 'pointer'}}
                                        type="checkbox"  
                                        name={`answer${answer.id}`} 
                                        value={answer.id}
                                        disabled={examMode == 'submit'?true:false}
                                        defaultChecked={typeof(selectedKey) !== 'undefined' && selectedKey.ans_id == answer.id}
                                        className="custom-control-input answer-list"
                                        id={`answer${answer.id}`}
                                        onChange={(event) => answeringHandler(event, answers.id, index)}
                                        />
                                        <label style={{fontSize:23, color: 'black', fontWeight: 600}} className="custom-control-label" for={`answer${answer.id}`}>{answer.answer}</label>
                                    </div>
                                </div>
                                </div>
                            )
                        })}
                        </div>
                    )
                })
            }
        </div>
    )
}

export default Answers;
