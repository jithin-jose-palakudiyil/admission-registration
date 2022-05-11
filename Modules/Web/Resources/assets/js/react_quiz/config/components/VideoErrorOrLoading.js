import React from 'react';
import {Spinner} from 'react-bootstrap'

const VideoErrorOrLoading = ({children, type, imageUrl}) => {
    return (
        <div className="loading-error-container">
            <img style={{maxHeight: 230}} src={imageUrl} alt="" />
            {
                type == 'load' ?
                <h4 style={{marginTop: 25}}>Loading Video... <Spinner animation="border" variant="primary" /></h4>:
                <h4 style={{marginTop: 25}}>Video not able to load !</h4>
            }
            <div className="form-group mb-0 text-center ">
                    {children}                             
            </div>
        </div>
    )
}

export default VideoErrorOrLoading;


