

var formatter = {
    account_number(v, r, i) {
        return r.member.acc_no !== null?formatNumber(r.member.acc_no):'-';
    },
    fullname(v, r, i) {
        return `${r.member.firstname} ${r.member.middlename} ${r.member.lastname}`;
    },
    date(v, r, i) {
        return moment(r.date).format('MMM DD, YYYY');
    },
    amount(v, r, i) {
        return currency(r.amount);
    }
};