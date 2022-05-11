import React from 'react';
import Vimeo from '@u-wave/react-vimeo';
import VideoErrorOrLoading from './VideoErrorOrLoading';


const Player = ({
    loading, 
    videoId, 
    loadErrorHandler, 
    setLoading, 
    setVideoLoadError, 
    type,
    videoLoadError, }) => {


    const opts = {
        height: '500',
        width: '100%',
        playerVars: {
            autoplay: 1,
            rel: 0
        },
      };


      const CheckVideoLoadError = () => {
        setLoading(false)
      setVideoLoadError(true)
    }


    const checkVideoLoadReady = () => {
      setLoading(false)
    }



    return (
        <div style={{height: 500, width: '100%'}} className="col-lg-12">
            <div className={loading?"player-container-hidden" : "player-container"}>
                <Vimeo video={'568018248'}  responsive autoplay controls={false} onReady={checkVideoLoadReady} onError={CheckVideoLoadError} />
                {!loading && videoLoadError && 
                <VideoErrorOrLoading type="error" imageUrl={VideoLoadErrorImageUrl}>
                        <small onClick={loadErrorHandler} className="badge badge-light-success font-13 mt-1 badge-custom">
                            {type=='intro'?'Go Back':'Refresh page'} <i className="las la-arrow-right"></i>
                        </small> 
                </VideoErrorOrLoading> 
                }
            </div>  
            <div className="video-container">
                {loading && 
                    <VideoErrorOrLoading type="load" imageUrl={VideoLoadImageUrl}/>
                }

            </div>
        </div>
    )

}

export default Player;
