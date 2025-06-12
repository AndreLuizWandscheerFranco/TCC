
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
/**
 *
 * @author aluno
 */
public class usuario {

    private int Id;
    private String nome;
    private int cpf;
    private int telefone;
    private String pais;
    private String cep;
    private String rua;
    private String numero;
    private String cidade;
    private String estado;
    private int tipo;

    public usuario() {
    }

    public usuario(int Id, String nome, int cpf, int telefone, String pais, String cep, String rua, String numero, String cidade, String estado, int tipo) {
        this.Id = Id;
        this.nome = nome;
        this.cpf = cpf;
        this.telefone = telefone;
        this.pais = pais;
        this.cep = cep;
        this.rua = rua;
        this.numero = numero;
        this.cidade = cidade;
        this.estado = estado;
        this.tipo = tipo;
    }
    
    
    public String getNome() {
        return nome;
    }

    public int getCpf() {
        return cpf;
    }

    public int getTelefone() {
        return telefone;
    }

    public String getPais() {
        return pais;
    }

    public String getCep() {
        return cep;
    }

    public String getRua() {
        return rua;
    }

    public String getNumero() {
        return numero;
    }

    public String getCidade() {
        return cidade;
    }

    public String getEstado() {
        return estado;
    }

    public int getTipo() {
        return tipo;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public void setCpf(int cpf) {
        this.cpf = cpf;
    }

    public void setTelefone(int telefone) {
        this.telefone = telefone;
    }

    public void setPais(String pais) {
        this.pais = pais;
    }

    public void setCep(String cep) {
        this.cep = cep;
    }

    public void setRua(String rua) {
        this.rua = rua;
    }

    public void setNumero(String numero) {
        this.numero = numero;
    }

    public void setCidade(String cidade) {
        this.cidade = cidade;
    }

    public void setEstado(String estado) {
        this.estado = estado;
    }

    public void setTipo(int tipo) {
        this.tipo = tipo;
    }

    @Override
    public String toString() {
        return "usuario{" + "Id=" + Id + ", nome=" + nome + ", cpf=" + cpf + ", telefone=" + telefone + ", pais=" + pais + ", cep=" + cep + ", rua=" + rua + ", numero=" + numero + ", cidade=" + cidade + ", estado=" + estado + ", tipo=" + tipo + '}';
    }

    
   
}
