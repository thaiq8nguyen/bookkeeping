import Login from "Views/Login";
import Logout from "Views/Logout";
import Dashboard from "Views/Dashboard";
import TransactionDetail from "Views/TransactionDetail";
import Unauthorized from "Views/Unauthorized";

import UserDashboard from "Views/RenterDashboard";
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
    // ADMIN'S ROUTE
    {
        name: "Dashboard",
        path: "/dashboard",
        component: Dashboard,
        beforeEnter: requiresAuth,
        meta: {
            isAdmin: true
        }
    },
    {
        name: "TransactionDetail",
        path: "/transactions/:id",
        component: TransactionDetail,
        beforeEnter: requiresAuth,
    },
    {
        name: "Settings",
        path: "/settings",
        component: Settings,
        beforeEnter: requiresAuth,
        meta: {
            isAdmin: true
        }
    },
    {
        name: "Unauthorized",
        path: "/unauthorized",
        component: Unauthorized,
        beforeEnter: requiresAuth
    },
    {
        name: "RenterDashboard",
        path: "/renter/dashboard",
        component: UserDashboard,
        beforeEnter: requiresAuth,
    },
    {
        name: "InvoiceDetail",
        path: "/invoice/:id",
        component: InvoiceDetail,
        beforeEnter: requiresAuth,
    },

];

async function requiresAuth (to, from, next) {

    await Store.getters["Authentications/isAuthenticated"];

    if (Store.getters["Authentications/isAuthenticated"]) {

        let role = Store.getters["Authentications/role"];

        if (to.matched.some(record => record.meta.isAdmin)) {

            if (role === "admin") {

                next();

            } else {

                next({

                    name: "Unauthorized"

                });

            }

        } else {

            next();

        }

    } else {

        next({

            path: "/login",
            query: { error: "unauthenticated" }

        });

    }

}
export default routes;
