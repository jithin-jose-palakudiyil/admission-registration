import React,{useState, useEffect, useRef} from 'react';
import moment,{duration} from 'moment';


const Timer = ({quizTimer, setTimeOver, setTimeLoading, style}) => {

    
    //timer States
    const [timerHours, setTimerHours] = useState(0);
    const [timerMinutes, setTimerMinutes] = useState(0);
    const [timerSeconds, setTimerSeconds] = useState(0);
    const [timerSum, setTimerSum] = useState(null)
    //end timer states

//    if(isNaN(timerHours)===true && isNaN(timerMinutes)===true && isNaN(timerSeconds)===true ){
//     localStorage.setItem("timer", moment().add(localStorage.getItem("time") , 'hours').format())
//    }

    let interval = useRef();
    const currentInterval = interval.current
     
     
  const startTimer = () => {

    interval = setInterval(() => {
        const countDownDate = moment(`${quizTimer}`)
        const now = moment().format()
        const distance = duration(countDownDate.diff(now))

        const hours = distance.hours();
        const minutes = distance.minutes();
        const seconds = distance.seconds();
        const timerAdd = hours + minutes + seconds;
        

        if(isNaN(hours) || isNaN(minutes) || isNaN(seconds)) return;
       


        if(distance < 0){
            clearInterval(currentInterval);
            
        }else{
            setTimerHours(hours);
            setTimerMinutes(minutes);
            setTimerSeconds(seconds);
            setTimerSum(timerAdd)
        }
    }, 1000)
}

    useEffect(() => {
        setTimeLoading(true)
        if(timerSum == 0 || timerSum == null){
            setTimeOver(true)
        }else{
            setTimeOver(false)
        }
        if(timerSum == 0){setTimeLoading(false)}
    }, [timerSum, setTimeOver])


    useEffect(() => {
        startTimer();
        return () => {
            clearInterval(currentInterval);
            
        }
    });
   


    return(
        <div style={{...style}} className="Timer">
            <i className="TimeLeftTag las la-stopwatch"></i> 
            {/* <p>{timerHours<10? `0${timerHours}`:timerHours}</p> :  */}
            <p>{timerMinutes<10 ? `0${timerMinutes}`: timerMinutes}</p>  :  <p>{timerSeconds<10 ? `0${timerSeconds}`: timerSeconds}</p>
        </div>
  
    )

    }

export default Timer;
