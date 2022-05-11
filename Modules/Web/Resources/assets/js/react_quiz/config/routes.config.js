import React from 'react'
import { Route, Switch } from 'react-router';
import Exam from '../pages/exam/exam';
import NotFound from '../pages/404/404';
import Introduction from '../pages/introduction/introduction';
import { routes } from './routes.constants';


const ExamRoutes = () => {

    return (
        <Switch>
            <Route exact path={routes.introduction.path} component={Introduction}/>
            <Route exact path={routes.exam.path} component={Exam}/>
            <Route component={NotFound}/>
        </Switch>
    )   
}

export default ExamRoutes;
