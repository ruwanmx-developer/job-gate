const name_pattern = /^[A-Z a-z]+$/;
const cname_pattern = /^[A-Z a-z 0-9]+$/;
const address_pattern = /^[A-Z a-z 0-9 , . / -]+$/;
const description_pattern = /^[A-Z a-z 0-9 , . / - ' " ( ) : ]+$/;
const email_pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
const job_category_pattern = /^[A-Z a-z]+$/;
const password_pattern =
  /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
// orijinals
