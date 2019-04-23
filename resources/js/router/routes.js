import Login from "Views/Login";
import Logout from "Views/Logout";
import Dashboard from "Views/Dashboard";
import TransactionDetail from "Views/TransactionDetail";
import InvoiceDetail from "Views/InvoiceDetail";
import Settings from "Views/Settings";
import Store from "Store";

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
        component: Logout,
        beforeEnter: requiresAuth
    },
    {

        name: "Dashboard",
        path: "/dashboard",
        component: Dashboard,
        beforeEnter: requiresAuth

    },
    {

        name: "TransactionDetail",
        path: "/transactions/:id",
        component: TransactionDetail,
        beforeEnter: requiresAuth

    },
    {
        name: "InvoiceDetail",
        path: "/invoice/:id",
        component: InvoiceDetail,
        beforeEnter: requiresAuth
    },
    {
        name: "Settings",
        path: "/settings",
        component: Settings,
        beforeEnter: requiresAuth
    }
];

async function requiresAuth (to, from, next) {
    console.log(to.fullPath);
    await Store.getters["Authentications/isAuthenticated"];

    if (Store.getters["Authentications/isAuthenticated"]) {

        next();

    } else {

        next({

            path: "/login",
            query: { url: to.path }

        });

    }

}
export default routes;
