/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package action;

import daos.DAOFactory;
import daos.OracleDAOFactory;
import java.sql.SQLException;

/**
 *
 * @author gobierno
 */
public class validarBD {
    public static void main(String[] args) throws SQLException {
        //DAOFactory conexion = new DAOFactory();
          OracleDAOFactory conexion = new OracleDAOFactory();
        conexion.createConnection();
        
        conexion.Consulta("'15EPR0304R'", "'DISH910513HMCZLB19'");
        
    }
    
}
