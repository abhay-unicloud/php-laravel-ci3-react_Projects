import {Container,Row,Col,Stack,Image,Nav,NavLink} from "react-bootstrap";

export default function Myfooter() {
    return(
        <footer>
        <Container fluid>
            <Row className="bg-primary text-white">
                <Col className="mx-5">
                    <Stack>
                       
                            <h2>Filmy Flamboyant</h2>
                            <p>lets talk only Cinema!</p>
                        
                    </Stack>
                
                </Col>
                <Col>
                <Nav className="flex-column fs-5">
                    Useful Links
                    <NavLink href="#" className="text-white">home</NavLink>
                    <NavLink href="#" className="text-white">list</NavLink>
                    <NavLink href="#" className="text-white">register</NavLink>
                </Nav>
                </Col>
                <Col>
                <Nav className="flex-column fs-5">
                    Reach us!
                <NavLink href="#" className="text-white">Contack Us</NavLink>
                    <NavLink href="#" className="text-white">Our Service</NavLink>
                    <NavLink href="#" className="text-white">Careers    </NavLink>
                    </Nav>
                </Col>
            </Row>
        </Container>
        </footer>
    );


}