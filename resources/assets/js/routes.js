
import VueRouter from 'vue-router';

let routes = [{
	path: '/',
	component: require('./components/Dashboard')
}];

export default new VueRouter({
	routes
});