
function SendPost() {
    //��������� POST ������ � ������� �����
    $$a({
        type:'post',//��� �������: get,post ���� head
        url:'ajax.php',//url ����� ����� �����������
        data:{'z':'1'},//��������� �������
        response:'text',//��� ������������� ������ text ���� xml
        success:function (data) {//������������ ��������� �� �������
            $$('result',$$('result').innerHTML+'<br />'+data);
        }
});
}
