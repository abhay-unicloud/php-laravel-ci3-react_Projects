import Navbar from 'react-bootstrap/Navbar'; 
import Nav from "react-bootstrap/Nav";
import Container from "react-bootstrap/Container";
import NavDropdown from "react-bootstrap/NavDropdown";
export default function MyNavbar(){
    return (
        <div>
        <Navbar expand="lg"
                bg="info">
            <Container>
                <Navbar.Brand href="#home">
                    Rahul Raghvendra
                </Navbar.Brand>
                <Navbar.Toggle aria-controls="basic-navbar-nav" />
                <Navbar.Collapse id="basic-navbar-nav">
                    <Nav className="me-auto">
                        <Nav.Link href="">Home</Nav.Link>
                        <Nav.Link href="">List</Nav.Link>
                        <Nav.Link href="">Register</Nav.Link>
                                               <NavDropdown title="Web Technology"
                                     id="collasible-nav-dropdown">
                            <NavDropdown.Item href=""> React </NavDropdown.Item>
                            <NavDropdown.Item href=""> Angular </NavDropdown.Item>
                            <NavDropdown.Item href=""> HTML </NavDropdown.Item>
                            <NavDropdown.Item href=""> CSS </NavDropdown.Item>
                            <NavDropdown.Item href=""> Javascript </NavDropdown.Item>
                        </NavDropdown>
                    </Nav>
                </Navbar.Collapse>
            </Container>
        </Navbar>
    </div>



    );
}