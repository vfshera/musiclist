
import Home from "./components/Home";
import Beats from "./components/Beats";
import Drumkits from "./components/Drumkits";
import Blogs from "./components/Blogs";
import Gallery from "./components/Gallery";
import Blog from "./components/Blog";
import FrontBlog from "./components/FrontBlog";
import Drumkit from "./components/Drumkit";
import FrontDrumkit from "./components/FrontDrumkit";
import Beat from "./components/Beat";
import Donate from "./components/Donate";
import FrontDrumkits from "./components/FrontDrumkits";
import FrontBlogs from "./components/FrontBlogs";
import FrontBeats from "./components/FrontBeats";
import NotFound from "./components/NotFound";
import Dashboard from "./components/Dashboard";
import TermsConditions from "./components/TermsConditions";
import CheckOut from "./components/Checkout";
import Info from "./components/Info";
import CancelNews from "./components/CancelNews";

export const  routes = [
    {
        path : '/',
        component : Home
    },
    {
        path : '/home',
        component : Dashboard,
        meta: { requiresAuth : true}
    },
    {
        path : '/donate',
        component : Donate
    },
    {
        path : '/newsletter/cancel',
        component : CancelNews
    },
    {
        path : '/info',
        component : Info
    },
    {
        path : '/checkout',
        component : CheckOut
    },
    {
        path : '/terms-and-conditions',
        component : TermsConditions
    },
    {
        path : '/beats',
        component : Beats,
        meta: { requiresAuth : true}
    },
    {
        path : '/tracks',
        component : FrontBeats,
        name: 'allTracks',
    },
    {
        path : '/beat/:id/:title',
        component : Beat,
        name: 'viewBeat',
        meta: { requiresAuth : true}
    },
    {
        path : '/drumkits',
        component : Drumkits,
        meta: { requiresAuth : true}
    },
    {
        path : '/soundkits',
        name: 'allDrumkits',
        component : FrontDrumkits,
    },
    {
        path : '/drumkit/:id/:title',
        component : Drumkit,
        name: 'viewDrumkit',
        meta: { requiresAuth : true}
    },
    {
        path : '/drumkit/show/:id/:title',
        component : FrontDrumkit,
        name: 'drumkitView'
    },
    {
        path : '/blogs',
        component : Blogs,
        meta: { requiresAuth : true}
    },
    {
        path : '/blog-posts',
        component : FrontBlogs,
        name : 'frontBlogs'
    },
    {
        path : '/blog/:id/:title',
        component : Blog,
        name: 'blog',
        meta: { requiresAuth : true}
    },
    {
        path : '/blogpost/:id/:title',
        name: 'blogPost',
        component : FrontBlog
    },
    {
        path : '/gallery',
        component : Gallery,
        meta: { requiresAuth : true}
    },
    {
        path : '*',
        component : NotFound,
    }
]



