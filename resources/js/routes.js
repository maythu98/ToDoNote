import Vue from 'vue';
import VueRouter from 'vue-router';
import ExampleComponent from './components/ExampleComponent.vue';
import NoteComponent from './components/NoteComponent.vue';

Vue.use(VueRouter);

const routes = [
    {
        path:"/example",
        name:"example-component",
        component:ExampleComponent
    },
    {
    	path: '/note',
    	name:"note-component",
    	component:NoteComponent
    }
]

const router = new VueRouter({
	hashband: false,
	history: true,
	mode: "history",
	routes
});

export default router;
