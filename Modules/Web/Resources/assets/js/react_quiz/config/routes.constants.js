import {react_base_url} from '../constants';


export const routes = {
    introduction:{
        // path: `/mgm-scholarship/dashboard/start-quiz/introduction/${encrypted_quiz_id}` //ihubworks/mgm-scholarship
    // path: `/mgm/dashboard/start-quiz/introduction/${encrypted_quiz_id}` //local
        path: `/dashboard/start-quiz/introduction/${encrypted_quiz_id}` //scholarship.mgmtc.in


    },
    exam:{
        // path: `/mgm-scholarship/dashboard/start-quiz/exam/${encrypted_quiz_id}` //ihubworks/mgm-scholarship
        // path: `/mgm/dashboard/start-quiz/exam/${encrypted_quiz_id}`
        path: `/dashboard/start-quiz/exam/${encrypted_quiz_id}` //scholarship.mgmtc.in

    },

    // notFound:{
    //     path: `${ADMIN_BASE_URL}/NotFound`
    // }
}
