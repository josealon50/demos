import axios from 'axios';

const instance = axios.create({
    baseURL: 'http://localhost:80/v1'

});

export default instance;
