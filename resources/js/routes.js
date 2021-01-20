
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

export const  routes = [
    {
        path : '/',
        component : Home
    },
    {
        path : '/beats',
        component : Beats,
        meta: { requiresAuth : true}
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
    }
]



