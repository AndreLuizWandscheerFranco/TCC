
import java.util.Date;

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */

/**
 *
 * @author aluno
 */
public class pagamento {
private int id;
private double valor;
private Date data;



    public pagamento() {
    }

    public pagamento(int id, double valor, Date data) {
        this.id = id;
        this.valor = valor;
        this.data = data;
    }

    public double getValor() {
        return valor;
    }

    public Date getData() {
        return data;
    }

    public void setValor(double valor) {
        this.valor = valor;
    }

    public void setData(Date data) {
        this.data = data;
    }

    @Override
    public String toString() {
        return "pagamento{" + "id=" + id + ", valor=" + valor + ", data=" + data + '}';
    }



}
