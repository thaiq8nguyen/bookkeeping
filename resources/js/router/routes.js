import Login from "Views/Login";
import Logout from "Views/Logout";
import Dashboard from "Views/Dashboard";
import TransactionDetail from "Views/TransactionDetail";

const routes = [

    {

        name: "Login",
        path: "/login",
        component: Login

    },
    {
        path: "/",
        redirect: "/login"
    },
    {
        name: "Logout",
        path: "/logout",
        component: Logout
    },
    {

        name: "Dashboard",
        path: "/dashboard",
        component: Dashboard,
        meta: {

            requiresAuth: true,
            
        }

    },
    {
        name: "TransactionDetail",
        path: "/transactions/:id",
        component: TransactionDetail,
        meta: {

            requiresAuth: true,
            
        }
    }
];

export default routes;