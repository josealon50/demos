import React,  { Component, Fragment } from 'react';
import { connect } from 'react-redux';
import { Redirect } from 'react-router-dom';

import Button from '../../components/UI/Button/Button';
import Aux from '../../hoc/Aux/Aux';
import Spinner from '../../components/UI/Spinner/Spinner';
import styles from './Login.css';
import Input from '../../components/UI/Input/Input';
import logo from '../../assets/images/pricesmart-logo-vector.png';
import * as actions from '../../store/actions/index';

class Login extends Component {
    state = { 
        loginForm: {
            username: {
                elementType: 'input',
                elementConfig: {
                    type: 'text',
                    placeholder: 'Username'
                },  
                value: '', 
                validation: {
                    required: true
                },  
                title: "Username",
                valid: false,
                touched: false
            },  
            password: {
                elementType: 'input',
                elementConfig: {
                    type: 'password',
                    placeholder: 'password'
                },  
                value: '', 
                validation: {
                    required: true
                },  
                title: "Password",
                valid: false,
                touched: false
            },  
        },
        error: null
    }
    componentDidMount() {
        if ( this.props.error ){
            this.state.error = this.props.error.message;
        }
        
    }
    checkValidity(value, rules) {
        let isValid = true;
        if (!rules) {
            return true;
        }

        if (rules.required) {
            isValid = value.trim() !== '' && isValid;
        }

        if (rules.minLength) {
            isValid = value.length >= rules.minLength && isValid
        }

        if (rules.maxLength) {
            isValid = value.length <= rules.maxLength && isValid
        }

        if (rules.isEmail) {
            const pattern = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:  [a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
            isValid = pattern.test(value) && isValid
        }

        if (rules.isNumeric) {
            const pattern = /^\d+$/;
            isValid = pattern.test(value) && isValid
        }

        return isValid;
    }

    inputChangedHandler = (event, inputIdentifier) => {
        const updatedOrderForm = {
            ...this.state.loginForm
        };
        const updatedFormElement = { 
            ...updatedOrderForm[inputIdentifier]
        };
        updatedFormElement.value = event.target.value;
        updatedFormElement.valid = this.checkValidity(updatedFormElement.value, updatedFormElement.validation);
        updatedFormElement.touched = true;
        updatedOrderForm[inputIdentifier] = updatedFormElement;
        
        let formIsValid = true;
        for (let inputIdentifier in updatedOrderForm) {
            formIsValid = updatedOrderForm[inputIdentifier].valid && formIsValid;
        }
        this.setState({loginForm: updatedOrderForm, formIsValid: formIsValid});
    }

    submitHandler = ( event ) => {
        event.preventDefault();
        this.props.onAuth( this.state.loginForm.username.value, this.state.loginForm.password.value );
    }

    render() {
        const formElementsArray = [];
        for (let key in this.state.loginForm) {
            formElementsArray.push({
                id: key,
                config: this.state.loginForm[key]
            });
        }
       let form = (
           <div classname={styles.grandParentContainer}>
               <div classname={styles.parentcontainer}>
                   <form className={styles.form} onSubmit={this.submitHandler}>
                       {formElementsArray.map(formElement => (
                           <Fragment>
                               <Input 
                                   key={formElement.id}
                                   elementType={formElement.config.elementType}
                                   elementConfig={formElement.config.elementConfig}
                                   value={formElement.config.value}
                                   invalid={!formElement.config.valid}
                                   shouldValidate={formElement.config.validation}
                                   touched={formElement.config.touched}
                                   changed={(event) => this.inputChangedHandler(event, formElement.id)} />
                            </Fragment>
                            ))}
                        <Button className={styles.buttong} disabled={!this.state.formIsValid}>Log In</Button>
                    </form>
               </div>
            </div>
        );
        let error = null; 
        if( this.props.error ){
            const style = {
                color: 'red',
            }
            error = <h4 style={{style}}>{this.props.error.message}</h4>;
        }
        return (
             <Fragment>
                <img src={logo} alt='Logo' style={{width:'200px', height:'121px'}}/>
                {error}    
                {form}
             </Fragment>
        );

    }

}

const mapStateToProps = state => {
    return {
        loading: state.auth.loading,
        error: state.auth.error,
        isAuthenticated: state.auth.token !== null,
        authRedirectPath: state.auth.authRedirectPath
    };  
};

const mapDispatchToProps = dispatch => {
    return {
        onAuth: ( username, password, isSignup ) => dispatch( actions.auth( username, password, isSignup ) ),
        onSetAuthRedirectPath: () => dispatch(actions.setAuthRedirectPath('/'))
    };  
};
export default connect( mapStateToProps, mapDispatchToProps )( Login );
