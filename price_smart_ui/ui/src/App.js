import React, { Component } from 'react';
import { Route, Switch, withRouter, Redirect } from 'react-router-dom';
import { connect } from 'react-redux';

import './App.css';
import Login from './containers/Login/Login';
import * as actions from './store/actions/index';

function App() {
  return (
    <div className="App">
      <Switch>
        <Route exact path="/" component={Login} />
      </Switch>
    </div>
  );
}
const mapStateToProps = state => {
    return {
        isAuthenticated: state.auth.token !== null
    };  
};

const mapDispatchToProps = dispatch => {
    return {
        onTryAutoSignup: () => dispatch( actions.authCheckState() )
    };  
};

export default withRouter( connect( mapStateToProps, mapDispatchToProps ) ( App ) );
