import React from 'react';
import YouTube from 'react-youtube';
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
            rel: 0, 
            controls:0,
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
                <YouTube videoId={videoId} opts={opts} onReady={checkVideoLoadReady} onError={CheckVideoLoadError} />
            </div>  
            <div className="video-container">
                {loading && 
                    <VideoErrorOrLoading type="load" imageUrl={VideoLoadImageUrl}/>
                }

                {!loading && videoLoadError && 
                <VideoErrorOrLoading type="error" imageUrl={VideoLoadErrorImageUrl}>
                        <small onClick={loadErrorHandler} className="badge badge-light-success font-13 mt-1 badge-custom">
                            {'Refresh page'} <i className="las la-arrow-right"></i>
                        </small> 
                </VideoErrorOrLoading> 
                }
            </div>
        </div>
    )

}

export default Player;


<div style={{paddingTop:'56.25%', position:'relative'}}><iframe src="https://player.vimeo.com/video/572750152?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style={{position:'absolute', top:0, left:0, width:'100%', height:'100%',}} title="09.mov"></iframe></div>
